<?php

    namespace SilverStripe\phasmophobia;

    use SilverStripe\ORM\DataObject;
    use SilverStripe\Forms\FieldList;
    use SilverStripe\Forms\TextField;

    class Evidence extends DataObject {

        private static $db = [
            'Name' => 'Varchar'
        ];

        private static $has_one = [
            'GhostPage' => GhostPage::class
        ];

        private static $belongs_many_many = [
            'Ghosts' => Ghost::class
        ];

        private static $default_sort = 'Name ASC';

        private static $table_name = 'Evidence';

        public function getCMSFields() {
            $fields = FieldList::create(
                TextField::create('Name')
            );
            return $fields;
        }

    }