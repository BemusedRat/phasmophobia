<?php

    namespace SilverStripe\phasmophobia;

    use Page;
    use SilverStripe\Forms\GridField\GridField;
    use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
    
    class GhostPage extends Page {

        private static $has_many = [
            'Ghosts' => Ghost::class,
            'EvidenceTypes' => Evidence::class
        ];

        private static $table_name = 'GhostPage';

        public function getCMSFields() {
            $fields = parent::getCMSFields();
            
            // Create GridField for Ghosts
            $GhostGridField = GridField::create(
                'Ghosts',
                'Ghost types',
                $this->Ghosts(),
                GridFieldConfig_RecordEditor::create()
            );

            // Create GridField for Evidence
            $EvidenceGridField = GridField::create(
                'EvidenceTypes',
                'Evidence types',
                $this->EvidenceTypes(),
                GridFieldConfig_RecordEditor::create()
            );

            // Add GridFields to $fields
            $fields->addFieldToTab('Root.Ghosts', $GhostGridField);
            $fields->addFieldToTab('Root.Evidence', $EvidenceGridField);

            return $fields;
        }

    }