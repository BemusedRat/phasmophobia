<?php

    namespace SilverStripe\phasmophobia;

    use SilverStripe\Control\Controller;
    use SilverStripe\ORM\DataObject;
    use SilverStripe\ORM\DataList;
    use SilverStripe\Forms\FieldList;
    use SilverStripe\Forms\TextField;
    use SilverStripe\Forms\CheckboxSetField;

    class Ghost extends DataObject {

        private static $db = [
            'Name' => 'Varchar',
        ];

        private static $has_one = [
            'GhostPage' => GhostPage::class,
        ];

        private static $many_many = [
            'EvidenceTypes' => Evidence::class
        ];

        private static $default_sort = 'Name ASC';

        private static $table_name = 'Ghost';

        public function getCMSFields() {
            $fields = FieldList::create(
                TextField::create('Name'),
                CheckboxSetField::create(
                    'EvidenceTypes',
                    'Evidence Types',
                    $this->GhostPage()->EvidenceTypes()->map('ID', 'Title')
                )
            );
            return $fields;
        }

        public function getRequiredEvidence() {

            // Get evidence IDs from query string
            $Controller = Controller::curr();
            $e1 = $Controller->getRequest()->getVar('e1');
            $e2 = $Controller->getRequest()->getVar('e2');
            $e3 = $Controller->getRequest()->getVar('e3');            

            // Do nothing if no evidence has been selected yet
            if(!$e1) {
                return null;
            }

            // Get evidence types based on query string
            $evidence1 = Evidence::get()->filter('ID', $e1)->First()->ID;
            if($e2) {
                $evidence2 = Evidence::get()->filter('ID', $e2)->First()->ID;
            }
            if($e3) {
                $evidence3 = Evidence::get()->filter('ID', $e3)->First()->ID;
            }

            // Evidence that still needs to be collected
            $RequiredEvidence = array();

            // The current ghosts evidence types
            $Evidences = $this->EvidenceTypes();

            // Check each evidence type for this ghost against what was selected in the form to see which ones match (marked 'Selected')
            foreach ($Evidences as $Evidence) {
                $Selected = false;
                if($Evidence->ID == $evidence1) {
                    $Selected = true;
                }
                if($e2){
                    if($Evidence->ID == $evidence2) {
                        $Selected = true;
                    }
                }
                if($e3) {
                    if($Evidence->ID == $evidence3) {
                        $Selected = true;
                    }
                }

                // If the current evidence type does NOT match any of the evidence types selected, then add it to the Required list as it is still required
                if(!$Selected) {
                    array_push($RequiredEvidence, $Evidence->ID);
                }
            }

            // If $RequiredEvidence is empty then we return null as ALL the evidence for this ghost has been selected in the form. Nothing is still required.
            if(empty($RequiredEvidence)){return null;}

            // If there IS evidence still to get, then return them to the template as a list to be displayed
            $RequiredEvidences = Evidence::get()->filter('ID', $RequiredEvidence);

            return $RequiredEvidences;

        }

    }