<?php  // $Id: view.php,v 1.10 2008/12/01 13:18:25 jamiesensei Exp $
/**
 * This page prints a particular instance of qcreate
 *
 * @author
 * @version $Id: view.php,v 1.10 2008/12/01 13:18:25 jamiesensei Exp $
 * @package qcreate
 **/

/// (Replace qcreate with the name of your module)

require_once("../../config.php");
require_once("lib.php");
require_once("locallib.php");


$id = optional_param('id', 0, PARAM_INT); // Course Module ID, or
$a  = optional_param('a', 0, PARAM_INT);  // qcreate ID
$delete  = optional_param('delete', 0, PARAM_INT);  // question id to delete
$confirm  = optional_param('confirm', 0, PARAM_BOOL);  

if ($id) {
	if (! $cm = $DB->get_record("course_modules", array("id"=>$id))) {
		error("Course Module ID was incorrect");
	}

	if (! $course = $DB->get_record("course", array("id"=>$cm->course))) {
		error("Course is misconfigured");
	}

	if (! $qcreate = $DB->get_record("qcreate", array("id"=>$cm->instance))) {
		error("Course module is incorrect");
	}

} else {
	if (! $qcreate = $DB->get_record("qcreate", array("id"=>$a))) {
		error("Course module is incorrect");
	}
	if (! $course = $DB->get_record("course", array("id"=>$qcreate->course))) {
		error("Course is misconfigured");
	}
	if (! $cm = get_coursemodule_from_instance("qcreate", $qcreate->id, $course->id)) {
		error("Course Module ID was incorrect");
	}
}
$qcreate->cmidnumber = $cm->id;

$requireds = $DB->get_records('qcreate_required', array('qcreateid'=>$qcreate->id), 'qtype', 'qtype, no, id');

$thisurl = new moodle_url('/mod/qcreate/view.php', array('id'=>$cm->id));
$PAGE->set_url($thisurl);

$modulecontext = context_module::instance($cm->id);



//modedit.php forwards to this page after creating coursemodule record.
//this is the first chance we get to set capabilities in the newly created
//context.
qcreate_student_q_access_sync($qcreate, $modulecontext, $course);


require_login($course->id);

if (has_capability('mod/qcreate:grade', $modulecontext)){
	redirect($CFG->wwwroot.'/mod/qcreate/edit.php?cmid='.$cm->id);
}


/// Print the page header
$strqcreates = get_string("modulenameplural", "qcreate");
$strqcreate  = get_string("modulename", "qcreate");

$navlinks = array();
$navlinks[] = array('name' => $strqcreates, 'link' => "index.php?id=$course->id", 'type' => 'activity');
$navlinks[] = array('name' => format_string($qcreate->name), 'link' => '', 'type' => 'activityinstance');

$navigation = build_navigation($navlinks);

$headerargs = array(format_string($qcreate->name), "", $navigation, "", "", true,
			  update_module_button($cm->id, $course->id, $strqcreate), navmenu($course, $cm));

if (!$cats = get_categories_for_contexts($modulecontext->id)){
	//if it has not been made yet then make a default cat
	question_make_default_categories(array($modulecontext));
	$cats = get_categories_for_contexts($modulecontext->id);
}
$catsinctx = array();
foreach ($cats as $catinctx){
	$catsinctx[]=$catinctx->id;
}
$catsinctxlist = join($catsinctx, ',');
$cat = array_shift($cats);

if ($delete && question_require_capability_on($delete, 'edit')){
	if ($confirm && confirm_sesskey()){
		if (!$DB->delete_records_select('question', "id = $delete AND category IN ($catsinctxlist)")){
			print_error('question_not_found');
		} else {
			qcreate_update_grades($qcreate, $USER->id);
			redirect($CFG->wwwroot.'/mod/qcreate/view.php?id='.$cm->id);
		}
	} else {
		call_user_func_array('print_header_simple', $headerargs);
		echo $OUTPUT->heading(get_string('delete'));
		echo $OUTPUT->confirm(get_string('confirmdeletequestion', 'qcreate'), 
			new moodle_url('view.php', array('id' => $cm->id, 'sesskey'=> sesskey(), 'confirm'=>1, 'delete'=>$delete)),
			new moodle_url('view.php', array('id' => $cm->id)));
		echo $OUTPUT->footer('none');
		die;
	}
}

call_user_func_array('print_header_simple', $headerargs);
add_to_log($course->id, "qcreate", "view", "view.php?id=$cm->id", "$qcreate->id");

$OUTPUT->box(format_text($qcreate->intro, $qcreate->introformat), 'generalbox', 'intro');

echo '<div class="mdl-align">';
echo '<p>'.qcreate_time_status($qcreate).'</p>';
echo '</div>';



qcreate_required_q_list($requireds, $cat, $thisurl, $qcreate, $cm, $modulecontext);

echo $OUTPUT->footer();
