<?php

    namespace SilverStripe\phasmophobia;

    use PageController;
    use SilverStripe\Control\Director;
    use SilverStripe\View\Requirements;
    use SilverStripe\ORM\DataObject;
    use SilverStripe\Forms\Form;
    use SilverStripe\Forms\FieldList;
    use SilverStripe\Forms\CheckboxSetField;
    use SilverStripe\Forms\FormAction;
    use SilverStripe\Forms\RequiredFields;

    class GhostPageController extends PageController {

        protected function init()
        {
            parent::init();
    
            //Requirements::javascript("<my-module-dir>/javascript/some_file.js");
            Requirements::css("vendor/bemusedrat/phasmophobia/css/phasmophobia.css");
        }


        private static $allowed_actions = [
            'EvidenceForm',
        ];

        // Create the frontend form to select evidence types
        public function EvidenceForm() {

            $EvidenceCheckBoxField = CheckboxSetField::create(
                'EvidenceTypes',
                'Select up to 3 evidence types to see which ghosts match.',
                $this->EvidenceTypes()->map('ID', 'Title')
            );

            $myForm = Form::create(
                $this,
                'EvidenceForm',
                FieldList::create(
                    $EvidenceCheckBoxField
                ),
                FieldList::create(
                    FormAction::create('sendEvidenceForm','Update')
                )
            );

            // Check if there's a string query in the URL and add those values array. This will enable pre-filling the form based on URL (for refreshes, link sharing, etc.)
            $e1 = $this->getRequest()->getVar('e1');
            $e2 = $this->getRequest()->getVar('e2');
            $e3 = $this->getRequest()->getVar('e3');
            $EvidenceTypes = array();

            // Push each evidence type to the array
            if($e3) {
                array_push($EvidenceTypes, $e3);
            }
            if($e2) {
                array_push($EvidenceTypes, $e2);
            }
            if($e1) {
                array_push($EvidenceTypes, $e1);
            } else {
                $EvidenceTypes = null;
            }

            // Pre-fill checkboxes with query string data from constructed array (if any)
            if($EvidenceTypes) {
                $EvidenceCheckBoxField->setDefaultItems($EvidenceTypes);
            }
    
            return $myForm;
        }

        // Action taken when the "Update" button gets pushed
        public function sendEvidenceForm($data, $form) {

            // Check for an empty form (nothing selected) and just refresh
            if(!isset($data['EvidenceTypes'])) {
                return $this->redirect($this->AbsoluteLink());
            }

            // Redirect with an error if more than 3 options are selected
            if(count($data['EvidenceTypes']) > 3) {
                $form->sessionError('Too many evidence types selected! Max = 3');
                return $this->redirectBack();
            }

            $EvidenceTypes = $data['EvidenceTypes'];
        
            // Contstruct query string to pre-fill the form and show results
            // TO-DO: Remove the trailing "&" after the last query string entry for le tidiness
            $querystring = "?";
            $i = 1;

            foreach ($EvidenceTypes as $key => $value) {
                $querystring = $querystring . 'e' . $i . '=' . $value . "&";
                $i++;
            }
    
            return $this->redirect($this->AbsoluteLink(). $querystring);
        }

        // Function to get the ghosts associated with the selected evidence. Returns a list of ghosts.
        public function getEvidencedGhosts() {
            // Get evidence IDs from query string
            $e1 = $this->getRequest()->getVar('e1');
            $e2 = $this->getRequest()->getVar('e2');
            $e3 = $this->getRequest()->getVar('e3');
            // Return all ghosts if no evidence has been selected
            if(!$e1) {
                return Ghost::get();
            }

            // This feels a bit awkward but we make an array of ghosts for each evidence type
            // We then use array_intersect to combine the arrays together to get only the ghosts that match ALL selected evidence types
            $Ghost1 = array();
            $Ghost2 = array();
            $Ghost3 = array();
            $Ghosts = array();

            // Get all ghosts matching the first evidence type
            $evidence1 = $this->EvidenceTypes()->filter('ID', $e1)->First();
            $Ghost1 = $evidence1->Ghosts()->columnUnique('ID');
            $GhostIDs = $Ghost1;

            // Get all ghosts matching the second evidence type
            if($e2) {
                $evidence2 = $this->EvidenceTypes()->filter('ID', $e2)->First();
                $Ghost2 = $evidence2->Ghosts()->columnUnique('ID');
                // Get rid of the ghosts that don't have both types of evidence
                $Ghosts1and2 = array_intersect($Ghost1, $Ghost2);
                $GhostIDs = $Ghosts1and2;
            }

            // Get all ghosts matching the second evidence type
            if($e3) {
                $evidence3 = $this->EvidenceTypes()->filter('ID', $e3)->First();
                $Ghost3 = $evidence3->Ghosts()->columnUnique('ID');
                // Get rid of the ghosts that don't have all 3 types of evidence
                $GhostIDs = array_intersect($Ghosts1and2, $Ghost3);
            }

            // Above we are simply working with the ghost IDs to keep things simple and hopefully speedy. Now we need to get the actual ghosts with those IDs.
            if($GhostIDs) {
                $Ghosts = Ghost::get()->filter('ID', $GhostIDs);
            } else {
                return null;
            }

            return $Ghosts;
        }

        // See if their is only one returned Ghost. This can then be highlighted on the front end as successful. Returns true or false
        public function getOnlyGhost() {
            $Ghosts = $this->getEvidencedGhosts();
            if(!$Ghosts){return null;}
            if($Ghosts->Count() == 1) {
                return true;
            } else {
                return false;
            }
        }

    }