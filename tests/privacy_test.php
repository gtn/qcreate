<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Privacy provider tests.
 *
 * @package    mod_qcreate
 * @copyright  2018 Jean-Michel Vedrine
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use core_privacy\tests\provider_testcase;
use core_privacy\local\request\approved_contextlist;
use core_privacy\local\request\transform;
use core_privacy\local\request\writer;
use mod_qcreate\privacy\provider;

defined('MOODLE_INTERNAL') || die();

global $CFG;

/**
 * Data provider testcase class.
 *
 * @package    mod_qcreate
 * @copyright  2018 Jean-Michel Vedrine
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_qcreate_privacy_testcase extends provider_testcase {

    /**
     * Test that a user who has no data gets no contexts
     */
    public function test_get_contexts_for_userid_no_data() {
        global $USER;
        $this->resetAfterTest();
        $this->setAdminUser();

        $contextlist = provider::get_contexts_for_userid($USER->id);
        $this->assertEmpty($contextlist);
    }

    /**
     * The export function should handle an empty contextlist properly.
     */
    public function test_export_user_data_no_data() {
        global $USER;
        $this->resetAfterTest();
        $this->setAdminUser();

        $approvedcontextlist = new \core_privacy\tests\request\approved_contextlist(
            \core_user::get_user($USER->id),
            'mod_qcreate',
            []
        );

        provider::export_user_data($approvedcontextlist);
        $this->assertDebuggingNotCalled();

        // No data should have been exported.
        $writer = \core_privacy\local\request\writer::with_context(\context_system::instance());
        $this->assertFalse($writer->has_any_data_in_any_context());
    }

    /**
     * The delete function should handle an empty contextlist properly.
     */
    public function test_delete_data_for_user_no_data() {
        global $USER;
        $this->resetAfterTest();
        $this->setAdminUser();

        $approvedcontextlist = new \core_privacy\tests\request\approved_contextlist(
            \core_user::get_user($USER->id),
            'mod_qcreate',
            []
        );

        provider::delete_data_for_user($approvedcontextlist);
        $this->assertDebuggingNotCalled();
    }

    /**
     * Export + Delete qcreate data for a user who has made a single attempt.
     */
    public function test_user_with_data() {
        global $DB;
        $this->resetAfterTest(true);

        $course = $this->getDataGenerator()->create_course();
        $coursecontext = \context_course::instance($course->id);

        $user = $this->getDataGenerator()->create_user();
       // echo " student : $user->id ";
        $teacher = $this->getDataGenerator()->create_user();
      //  echo " teacher : $teacher->id ";
        $this->getDataGenerator()->enrol_user($user->id, $course->id, 'student');
        $this->getDataGenerator()->enrol_user($teacher->id, $course->id, 'editingteacher');
        $otheruser = $this->getDataGenerator()->create_user();
        $this->getDataGenerator()->enrol_user($otheruser->id, $course->id, 'student');

        // Make a qcreate activity.
        $this->setUser($teacher);
        $qcreate = $this->create_test_qcreate($course);
        $cm = get_coursemodule_from_instance('qcreate', $qcreate->id);
        $context = context_module::instance($cm->id);

        // The qcreate_process_local_grade needs cmidnumber set.
        list($course, $cm) = get_course_and_cm_from_cmid($qcreate->cmid, 'qcreate');
        $qcreate->cmidnumber = $cm->id;

        // Create a question.
        $q1 = $this->qcreate_add_qcreate_question($user, $qcreate, 'shortanswer');

        // Grade question.
        $this->setUser($teacher);
        qcreate_process_local_grade($qcreate, $q1, false, false, 90, 'Good job.');

        // Fetch the contexts - only one context should be returned.
        $contextlist = provider::get_contexts_for_userid($user->id);
        $this->assertCount(1, $contextlist);
        $this->assertEquals($context, $contextlist->current());

        // Perform the export and check the data.
        $approvedcontextlist = new \core_privacy\tests\request\approved_contextlist(
            \core_user::get_user($user->id),
            'mod_qcreate',
            $contextlist->get_contextids()
        );
        provider::export_user_data($approvedcontextlist);

        // Ensure that the qcreate data was exported correctly.
        $writer = writer::with_context($context);
        $this->assertTrue($writer->has_any_data());

        $qcreatedata = $writer->get_data([]);
 //  echo " qcreate data in test ";
  //      var_dump($qcreatedata);
        $this->assertEquals($qcreate->name, $qcreatedata->name);

        // Every module has an intro.
        $this->assertTrue(isset($qcreatedata->intro));


        // Delete the data and check it is removed.
    //    $this->setUser();
    //    provider::delete_data_for_user($approvedcontextlist);
    //    $this->expectException(\dml_missing_record_exception::class);
    }

    /**
     * Export + Delete qcreate data for a user who has made a single attempt.
     */
/*    public function test_delete_data_for_all_users_in_context() {
        global $DB;
        $this->resetAfterTest(true);

        $course = $this->getDataGenerator()->create_course();
        $user = $this->getDataGenerator()->create_user();
        $otheruser = $this->getDataGenerator()->create_user();

        // Make a qcreate.
        $this->setUser();
        $qcreate = $this->create_test_qcreate($course);
        $cm = get_coursemodule_from_instance('qcreate', $qcreate->id);
        $context = context_module::instance($cm->id);

        //Create questions as 2 different users.
        $q1 = $this->qcreate_add_qcreate_question($user, $qcreate, 'shortanswer');
        $q2 = $this->qcreate_add_qcreate_question($otheruser, $qcreate, 'shortanswer');

        // Create another qcreate and questions, and repeat the data insertion.
        $this->setUser();
        $otherqcreate = $this->create_test_qcreate($course);

        // Create questions.
        $this->qcreate_add_qcreate_question($user, $otherqcreate, 'shortanswer');
        $this->qcreate_add_qcreate_question($otheruser, $otherqcreate, 'shortanswer');

        // Delete all data for all users in the context under test.
        $this->setUser();
        provider::delete_data_for_all_users_in_context($context);
        // The qcreate local grades should have been deleted.

    } */

    /**
     * Export + Delete qcreate data for a user who has made a single attempt.
     */
/*    public function test_wrong_context() {
        global $DB;
        $this->resetAfterTest(true);

        $course = $this->getDataGenerator()->create_course();
        $user = $this->getDataGenerator()->create_user();

        // Make a qcreate.
        $this->setUser();
        $plugingenerator = $this->getDataGenerator()->get_plugin_generator('mod_qcreate');
        $qcreate = $plugingenerator->create_instance(['course' => $course->id]);
        $cm = get_coursemodule_from_instance('qcreate', $qcreate->id);
        $context = \context_module::instance($cm->id);

        // Fetch the contexts - no context should be returned.
        $this->setUser();
        $contextlist = provider::get_contexts_for_userid($user->id);
        $this->assertCount(0, $contextlist);

        // Perform the export and check the data.
        $this->setUser($user);
        $approvedcontextlist = new \core_privacy\tests\request\approved_contextlist(
            \core_user::get_user($user->id),
            'mod_qcreate',
            [$context->id]
        );
        provider::export_user_data($approvedcontextlist);

        // Ensure that nothing was exported.
        $writer = writer::with_context($context);
        $this->assertFalse($writer->has_any_data_in_any_context());

        $this->setUser();

        $dbwrites = $DB->perf_get_writes();

        // Perform a deletion with the approved contextlist containing an incorrect context.
        $approvedcontextlist = new \core_privacy\tests\request\approved_contextlist(
            \core_user::get_user($user->id),
            'mod_qcreate',
            [$context->id]
        );
        provider::delete_data_for_user($approvedcontextlist);
        $this->assertEquals($dbwrites, $DB->perf_get_writes());
        $this->assertDebuggingNotCalled();

        // Perform a deletion of all data in the context.
        provider::delete_data_for_all_users_in_context($context);
        $this->assertEquals($dbwrites, $DB->perf_get_writes());
        $this->assertDebuggingNotCalled();
    } */

    /**
     * Create a test qcreate for the specified course.
     *
     * @param   \stdClass $course
     * @return  array
     */
    protected function create_test_qcreate($course) {
        global $DB;

        $qcreategenerator = $this->getDataGenerator()->get_plugin_generator('mod_qcreate');

        $qcreate = $qcreategenerator->create_instance(['course' => $course->id]);
        return $qcreate;
    }

    protected function qcreate_add_qcreate_question($user, $qcreate, $qtype) {
        $this->setUser($user);
        $cm = get_coursemodule_from_instance('qcreate', $qcreate->id);
        $context = context_module::instance($cm->id);
        $questiongenerator = $this->getDataGenerator()->get_plugin_generator('core_question');
        $cat = question_get_default_category($context->id);
        $q = $questiongenerator->create_question($qtype, null,
                array('category' => $cat->id));
        return $q;
    }
}
