<?php

if (!function_exists('question_type_menu')) {
	function question_type_menu() {
		$types = question_bank::get_creatable_qtypes();
		$returnTypes = array();
		
        foreach ($types as $name => $qtype) {
            $returnTypes[$name] = $qtype->local_name();
        }
		
		return $returnTypes;
	}
}

if (!function_exists('questionbank_navigation_tabs')) {
	function questionbank_navigation_tabs(&$row, $contexts, $querystring) {
		global $CFG, $QUESTION_EDITTABCAPS;
		$tabs = array(
				'questions' =>array("$CFG->wwwroot/question/edit.php?$querystring", get_string('questions', 'quiz'), get_string('editquestions', 'quiz')),
				'categories' =>array("$CFG->wwwroot/question/category.php?$querystring", get_string('categories', 'quiz'), get_string('editqcats', 'quiz')),
				'import' =>array("$CFG->wwwroot/question/import.php?$querystring", get_string('import', 'quiz'), get_string('importquestions', 'quiz')),
				'export' =>array("$CFG->wwwroot/question/export.php?$querystring", get_string('export', 'quiz'), get_string('exportquestions', 'quiz')));
		foreach ($tabs as $tabname => $tabparams){
			if ($contexts->have_one_edit_tab_cap($tabname)) {
				$row[] = new tabobject($tabname, $tabparams[0], $tabparams[1], $tabparams[2]);
			}
		}
	}
}