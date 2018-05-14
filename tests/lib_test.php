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
 * Unit tests for (some of) mod/qcreate/lib.php.
 *
 * @package    mod_qcreate
 * @category   phpunit
 * @copyright  2014 Jean-Michel Vedrine
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot . '/mod/qcreate/lib.php');
require_once($CFG->dirroot . '/mod/qcreate/locallib.php');
require_once($CFG->dirroot . '/mod/qcreate/tests/base_test.php');

/**
 * Unit tests for (some of) mod/qcreate/lib.php.
 *
 * @copyright  2014 Jean-Michel Vedrine
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_qcreate_lib_testcase extends mod_qcreate_base_testcase {

    protected function setUp() {
        parent::setUp();

        // Add additional default data.

    }

    public function test_qcreate_print_overview() {
        global $DB;
        $courses = $DB->get_records('course', array('id' => $this->course->id));
        $qcreate = $this->create_instance();

        // Create a question as student0.
        $this->setUser($this->students[0]);
        $questiongenerator = $this->getDataGenerator()->get_plugin_generator('core_question');
        $standardq = $questiongenerator->create_question('shortanswer', null,
                array('category' => $qcreate->get_question_category()->id));

        // Check the overview as the different users.
        $overview = array();
        qcreate_print_overview($courses, $overview);
        $this->assertDebuggingCalledCount(1);
        $this->assertEquals(count($overview), 1);

        $this->setUser($this->teachers[0]);
        $overview = array();
        qcreate_print_overview($courses, $overview);
        $this->assertDebuggingCalledCount(1);
        $this->assertEquals(count($overview), 1);

        $this->setUser($this->editingteachers[0]);
        $overview = array();
        qcreate_print_overview($courses, $overview);
        $this->assertDebuggingCalledCount(1);
        $this->assertEquals(1, count($overview));
    }

    public function test_print_recent_activity() {
        $this->setUser($this->editingteachers[0]);
        $qcreate = $this->create_instance();

        // Create a question as student0.
        $this->setUser($this->students[0]);
        $questiongenerator = $this->getDataGenerator()->get_plugin_generator('core_question');
        $standardq = $questiongenerator->create_question('shortanswer', null,
                array('category' => $qcreate->get_question_category()->id));

        $this->expectOutputRegex('/New questions created:/');
        qcreate_print_recent_activity($this->course, true, time() - 3600);
    }

    public function test_qcreate_get_recent_mod_activity() {
        $this->setUser($this->editingteachers[0]);
        $qcreate = $this->create_instance();

        // Create a question as student0.
        $this->setUser($this->students[0]);
        $questiongenerator = $this->getDataGenerator()->get_plugin_generator('core_question');
        $standardq = $questiongenerator->create_question('shortanswer', null,
                array('category' => $qcreate->get_question_category()->id));

        $activities = array();
        $index = 0;

        $activity = new stdClass();
        $activity->type    = 'activity';

        $activity->cmid    = $qcreate->get_course_module()->id;
        $activities[$index++] = $activity;

        qcreate_get_recent_mod_activity( $activities,
                                        $index,
                                        time() - 3600,
                                        $this->course->id,
                                        $qcreate->get_course_module()->id);

        $this->assertEquals("qcreate", $activities[1]->type);
    }

    public function test_qcreate_user_complete() {
        global $PAGE;

        $this->setUser($this->editingteachers[0]);
        $qcreate = $this->create_instance();

        $PAGE->set_url(new moodle_url('/mod/qcreate/view.php', array('id' => $qcreate->get_course_module()->id)));

        $this->expectOutputRegex('/Grade: -/');
        qcreate_user_complete($this->course, $this->students[0], $qcreate->get_course_module(), $qcreate->get_instance());

        // Create a question as student0.
        $this->setUser($this->students[0]);
        $questiongenerator = $this->getDataGenerator()->get_plugin_generator('core_question');
        $standardq = $questiongenerator->create_question('shortanswer', null,
                array('category' => $qcreate->get_question_category()->id));

        $this->expectOutputRegex('/Grade: -/');

        qcreate_user_complete($this->course, $this->students[0], $qcreate->get_course_module(), $qcreate->get_instance());
    }

    public function test_qcreate_get_completion_state() {
        $qcreate = $this->create_instance();

        $this->setUser($this->students[0]);
        $result = qcreate_get_completion_state($this->course, $qcreate->get_course_module(), $this->students[0]->id, false);
        $this->assertFalse($result);

        // Create a question as student0.
        $this->setUser($this->students[0]);
        $questiongenerator = $this->getDataGenerator()->get_plugin_generator('core_question');
        $standardq = $questiongenerator->create_question('shortanswer', null,
                array('category' => $qcreate->get_question_category()->id));

        $result = qcreate_get_completion_state($this->course, $qcreate->get_course_module(), $this->students[0]->id, false);

        $this->assertTrue($result);
    }

    /**
     * Tests for mod_qcreate_refresh_events.
     */
    public function test_qcreate_refresh_events() {
        global $DB;
        $this->resetAfterTest();
        $this->setAdminUser();

        $timeopen = time();
        // 15 days duration.
        $timeclose = time() + DAYSECS * 15;
        $newtimeclose = $timeclose + DAYSECS;

        $generator = $this->getDataGenerator();
        $course = $generator->create_course();
        $params = array();
        $params['course'] = $course->id;
        $params['timeopen'] = $timeopen;
        $params['timeclose'] = $timeclose;
        $qcreate = $this->create_instance($params);

        // Make sure the calendar events for qcreate 1 matches the initial parameters.
        $instance = $qcreate->get_instance();
        $this->assertTrue(qcreate_refresh_events($course->id));
        $eventparams = array('modulename' => 'qcreate', 'instance' => $instance->id, 'eventtype' => 'open');
        $openevent = $DB->get_record('event', $eventparams, '*', MUST_EXIST);
        $this->assertEquals($openevent->timestart, $timeopen);

        $eventparams = array('modulename' => 'qcreate', 'instance' => $instance->id, 'eventtype' => 'close');
        $closeevent = $DB->get_record('event', $eventparams, '*', MUST_EXIST);
        $this->assertEquals($closeevent->timestart, $timeclose);

        // In case the course ID is passed as a numeric string.
        $this->assertTrue(qcreate_refresh_events('' . $course->id));
        // Course ID not provided.
        $this->assertTrue(qcreate_refresh_events());
        $eventparams = array('modulename' => 'qcreate');
        $events = $DB->get_records('event', $eventparams);
        foreach ($events as $event) {
            if ($event->modulename === 'qcreate' && $event->instance === $instance->id && $event->eventtype === 'open') {
                $this->assertEquals($event->timestart, $timeopen);
            }
            if ($event->modulename === 'qcreate' && $event->instance === $instance->id && $event->eventtype === 'close') {
                $this->assertEquals($event->timestart, $timeclose);
            }
        }
        // Manually update qcreate 1's close time.
        $DB->update_record('qcreate', (object)['id' => $instance->id, 'timeclose' => $newtimeclose]);

        // Then refresh the qcreate events of qcreate 1's course.
        $this->assertTrue(qcreate_refresh_events($course->id));

        // Confirm that the qcreate 1's close date event now has the new close date after refresh.
        $eventparams = array('modulename' => 'qcreate', 'instance' => $instance->id, 'eventtype' => 'close');
        $eventtime = $DB->get_field('event', 'timestart', $eventparams, MUST_EXIST);
        $this->assertEquals($eventtime, $newtimeclose);

        // Create a second course and qcreate.
        $course2 = $generator->create_course();
        $params['course'] = $course2->id;
        $qcreate2 = $this->create_instance($params);
        $instance2 = $qcreate2->get_instance();

        // Manually update qcreate 1 and 2's close dates.
        $newtimeclose += DAYSECS;
        $DB->update_record('qcreate', (object)['id' => $instance->id, 'timeclose' => $newtimeclose]);
        $DB->update_record('qcreate', (object)['id' => $instance2->id, 'timeclose' => $newtimeclose]);

        // Refresh events of all courses.
        $this->assertTrue(qcreate_refresh_events());

        // Check the due date calendar event for qcreate 1.
        $eventtime = $DB->get_field('event', 'timestart', $eventparams, MUST_EXIST);
        $this->assertEquals($eventtime, $newtimeclose);

        // Check the due date calendar event for qcreate 2.
        $eventparams['instance'] = $instance2->id;
        $eventtime = $DB->get_field('event', 'timestart', $eventparams, MUST_EXIST);
        $this->assertEquals($eventtime, $newtimeclose);
    }
}
