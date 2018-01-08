@mod @mod_qcreate
Feature: Test creating a question in a qcreate activity
  As a student
  In order to get a grade in a Question creation activity
  I need to be able to create a question

  Background:
    Given the following "courses" exist:
      | fullname | shortname | category | groupmode |
      | Course 1 | C1 | 0 | 1 |
    And the following "users" exist:
      | username | firstname | lastname | email |
      | teacher1 | Teacher | 1 | teacher1@example.com |
      | student1 | Student | 1 | student1@example.com |
    And the following "course enrolments" exist:
      | user | course | role |
      | teacher1 | C1 | editingteacher |
      | student1 | C1 | student |

  @javascript
  Scenario: Student create a Multiple choice question
    When I log in as "teacher1"
    And I am on "Course 1" course homepage with editing mode on
    And I add a "Question Creation" to section "1" and I fill the form with:
      | Name                    | Question Creation 001          |
      | Description             | Question Creation description  |
      | To own questions        | preview                        |
      | Total Questions Graded  | 2                              |
    And I log out
    # We need to run the task to update students capabilities on questions
    And I run the scheduled task "mod_qcreate\task\synchronize_qaccess"
    And I log in as "student1"
    And I am on "Course 1" course homepage
    And I follow "Question Creation 001"
    And I follow "Multiple choice"
    And I set the following fields to these values:
      | Question name            | Multi-choice-001                   |
      | Question text            | Find the capital cities in Europe. |
      | General feedback         | Paris and London                   |
      | One or multiple answers? | Multiple answers allowed           |
      | Choice 1                 | Tokyo                              |
      | Choice 2                 | Spain                              |
      | Choice 3                 | London                             |
      | Choice 4                 | Barcelona                          |
      | Choice 5                 | Paris                              |
      | id_fraction_0            | None                               |
      | id_fraction_1            | None                               |
      | id_fraction_2            | 50%                                |
      | id_fraction_3            | None                               |
      | id_fraction_4            | 50%                                |
      | Hint 1                   | First hint                         |
      | Hint 2                   | Second hint                        |
    And I press "Save changes"
    Then I should see "You've done one extra question."
    And I should see "One question of any of the types below will be graded"
    And I should see "Multi-choice-001 (Not graded yet)"
    And I should see "You have been awarded a total grade of 50 / 100 for this activity."
    And I should see "A teacher has awarded you a grade of 0 / 50 for the questions you have done."