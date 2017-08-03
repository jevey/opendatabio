<?php

return array (
  'edit_user' => 'Edit User',
  'email' => 'E-mail address',
  'password' => 'Password',
  'password_change_hint' => 'Use this field to force the password for this user to be changed. Leave it blank if you don\'t want to edit it.',
  'save' => 'Save changes',
  'remove_user' => 'Remove User',
  'help' => 'Help!',
  'users_hint' => 'This table represent the system users. Each user has a valid e-mail and password, and an access level, which
        determines the actions he or she may take on the system. This table does not store information about
        plant or voucher collectors or specialists. Use the "Persons" tab for that.',
  'registered_users' => 'Registered Users',
  'locations' => 'Locations',
  'persons' => 'Persons',
  'references' => 'References',
  'herbaria' => 'Herbaria',
  'users' => 'Users',
  'userjobs' => 'Jobs',
  'login' => 'Login',
  'register' => 'Register',
  'edit_profile' => 'Edit profile',
  'references_hint' => 'This table contains the bibliographic references used when incorporating published data to the database.
        All references should be in Bibtex format - all major citation softwares are able to export to Bibtex format.

        Check the "standardize" box if you want to generate standard BibTeX keys for the imported entries. These will
        be used instead of the keys that are present in the files.',
  'import_references' => 'Import References',
  'standardize_keys' => 'Standardize Keys',
  'import_file' => 'Import File',
  'bibliographic_references' => 'Bibliographic References',
  'bibtex_key' => 'BibTeX Key',
  'authors' => 'Authors',
  'year' => 'Year',
  'title' => 'Title',
  'edit_reference' => 'Edit Reference',
  'bibtex_entry' => 'BibTeX entry',
  'remove_reference' => 'Remove Reference',
  'acronym' => 'Acronym',
  'institution' => 'Institution',
  'irn' => 'IRN',
  'hint_herbaria_page' => 'This table contains the registered herbaria in which the vouchers can be stored. All herbaria should have
        an identification number from the Index Herbariorum, which can be used to retrieve other details such as
        address, phone, or e-mail. You can register herbarias using the acronym (also called Herbarium Code), which
        normally consists on two to five letters. All other fields will be filled in automatically.',
  'new_herbarium' => 'Register Herbarium',
  'whoops' => 'Whoops! Something went wrong!',
  'checkih' => 'Check Index Herbariorum',
  'add' => 'Register!',
  'registered_herbaria' => 'Registered Herbaria',
  'details' => 'Details',
  'herbarium' => 'Herbarium',
  'remove_herbarium' => 'Remove Herbarium',
  'specialists' => 'Specialists',
  'abbreviation' => 'Abbreviation',
  'name' => 'Name',
  'userjobs_hint' => 'Jobs are requests that are processed on the background by the server. They are
	mostly used for importing and exporting data. Any user only has access to his/her own jobs.
	The status column indicates: "Submitted" if the job has been submitted, but it\'s still not being processed;
"Processing" if it\'s being processed by the database; "Success" if the execution ended without errors; 
"Failed" if the execution results in error and "Cancelled" if the user has asked the job to be cancelled. You may use
the buttons on the left of the table to attempt to cancel a job that has not finished, retry a job that has failed, or
remove the job information from the database.',
  'registered_userjobs' => 'Your Registered Jobs',
  'id' => 'ID',
  'status' => 'Status',
  'created_at' => 'Created',
  'updated_at' => 'Last updated',
  'actions' => 'Actions',
  'retry' => 'Retry',
  'cancel' => 'Cancel',
  'remove' => 'Remove',
  'monitor_userjob' => 'Monitor Job',
  'jobid' => 'Job ID',
  'type' => 'Type',
  'log' => 'Log',
  'notfound' => 'The item you are trying to see was not found in the database. Maybe you followed an outdated link?',
  'location_hint' => 'This table stores the geographical locations in which plants are collected, and samples are taken.',
  'registered_locations' => 'Registered Locations',
  'location' => 'Location',
  'location_name' => 'Location name',
  'total_descendants' => 'Total descendants',
  'location_ancestors_and_children' => 'Related locations',
  'home' => 'Home',
  'docs' => 'Documentation',
  'remember' => 'Remember me',
  'forgot' => 'Forgot password?',
  'confirm_password' => 'Confirm Password',
  'reset_password' => 'Reset Password',
  'send_password' => 'Send Password Reset Link',
  'current_password' => 'Current Password',
  'new_password' => 'New Password',
  'password_hint' => 'Use this field to change your password. Leave it blank if you don\'t want to edit it.',
  'default_person' => 'Default Person',
  'hint_default_person' => 'If you select a Person here, this will be used as the default Person on all relevant forms, such as when filling in vouchers or plants collected. You should probably set this to your own name.',
  'full_name' => 'Full Name',
  'abbreviation_hint' => 'The abbreviation field is the abbreviated name which the person uses in publications and other
        catalogs. It must contain only uppercase letters, hyphens, periods, commas or spaces. A valid abbreviation for
        the name "Charles Robert Darwin" would be "DARWIN, C. R.".
        When registering a new person, the system suggests the name abbreviation, but the user is free to change
        it to better adapt it to the usual abbreviation used by each person.
        The abbreviation should be unique for each person.',
  'person_herbarium_hint' => 'Fill this if this person is associated with an herbarium. He or she will then be listed as specialist.',
  'person_hint' => 'This table represent people which may or may not be directly involved with the database.
        It is used to store information about plant and voucher collectors, specialists, and database users.
        When registering a new person, the system suggests the name abbreviation, but the user is free to change
        it to better adapt it to the usual abbreviation used by each person.
        The abbreviation should be unique for each person.',
  'new_person' => 'New Person',
  'registered_persons' => 'Registered Persons',
  'edit_person' => 'Edit Person',
  'remove_person' => 'Remove Person',
  'stored' => 'Resources stored!',
  'saved' => 'Resources saved!',
  'fk_error' => 'This resource is associated with other objects and cannot be removed',
  'removed' => 'Resource removed!',
  'acronym_error' => 'You must provide an acronym!',
  'acronym_not_found' => 'Acronym not found or error accessing IH site!',
  'dispatched' => 'Job dispatched! See details on the Jobs tab.',
  'bibtex_error' => 'This file could not be parsed as valid BibTeX!',
  'version' => 'Version :version',
  'tag' => 'A modern system for storing and retrieving plant data - floristics, ecology and monitoring',
  'hint_herbaria' => 'This is the acronym used in the Index Herbariorium, which consists of two to six letters. The other fields will be filled in automatically.',
  'created' => 'Resources stored!',
  'new_location' => 'New/Edit Location',
  'create' => 'Create',
  'adm_level' => 'Administrative level',
  'location_adm_level_hint' => 'Stores the type of the location. Some types are actual administrative levels, related to the legal status of the location (countries, states, provinces, etc). Some are related to the nature of the location (such as a GPS point, or a plot).',
  'geometry' => 'Geometry',
  'geom_hint' => 'Store here the geometry of the location. This field accepts a Well Known Text of a Point, LineString, Polygon or MultiPolygon (such as the WKT that may be exported from a GIS system). NOTE that longitudes should be inserted before latitudes. Thus the WKT \'POINT(-44.0 -22.5 )\' refers to a point at 22 degrees and 30 minutes of latitude south and 44 degrees of longitude west).',
  'latitude' => 'Latitude',
  'longitude' => 'Longitude',
  'latlong_hint' => 'Enter here the latitude and longitude of the point or plot. If the latitude or longitude is expressed as decimal degrees, enter the degrees with a decimal point in the degree field (such as 22.5 degrees). If the latitude or longitude is expressed as decimal minutes, enter it with a decimal point in the minutes field (such as 22 degrees and 50.980 minutes).',
  'dimensions' => 'Dimensions',
  'start' => 'Start',
  'dimensions_hint' => 'The dimensions of a plot, expressed in meters.',
  'altitude' => 'Altitude',
  'datum' => 'Datum',
  'datum_hint' => 'This field contains the GPS datum associated with this location. If left blank, it is assumed that the datum is WGS84.',
  'location_parent' => 'Parent',
  'location_parent_hint' => 'This field stores the parent of the current location. Store here the parent location one administrative level above. For example, if the location is a city, store the city\'s state. If the location is a federal conservation unit, store the country.',
  'location_uc' => 'Conservation Unit',
  'location_uc_hint' => 'If this is a plot or point inside a conservation unit, store this information here.',
  'notes' => 'Notes',
  'position' => 'Position',
  'uc' => 'Conservation Unit',
  'edit' => 'Edit',
  'location_map' => 'Location map',
  'geom_error' => 'The geometry informed is invalid. Check for missing parentheses, extra commas, and verify that the last position in a polygon is equal to the first.',
  'unauthorized' => 'The current user is not authorized to perform this action!',
  'person_details' => 'Person details',
  'bibreference' => 'Bibliographic reference',
  'bibtex_at_error' => 'The BibTex entry must start with an @ sign!',
  'remove_location' => 'Remove Location',
  'confirm_person' => 'Confirm Person insertion',
  'possible_dupes' => 'Possible duplicates',
  'confirm_person_message' => 'Please check that the new Person you are attempting to insert is not a duplicate of the following stored persons. If you are certain that this record is of a new person, not a duplicate, press the button below to finish the insertion.',
  'movenotpossible' => 'Impossible to move node to this parent.',
  'location_map_error' => 'Error loading the map for this location...',
  'simplified_map' => 'This map was simplified for display...',
  'hint_taxon_name' => 'Enter the full name of the taxon, including subspecies or variety, but without author. Ex: "Licaria cannella"',
  'checkapis' => 'Check APIs!',
  'taxon_level' => 'Level',
  'taxon_level_hint' => 'Fill in the taxonomic level for this taxon.',
  'parent' => 'Parent',
  'taxon_parent_hint' => 'What is the taxon above this one? For a species, this must be a genus, for a genus this is usually a family, and so on.',
  'senior' => 'Senior',
  'taxon_senior_hint' => 'Fill this box if the taxon name being registered is a junior synonym of another name. A name registered as junior may not be registered as valid.',
  'taxon_author' => 'Author',
  'taxon_author_hint' => 'Provide either the name of the author, if the taxon is described in the literature, or the Person associated with it, in case the taxon is still unpublished. Do not fill both fields.',
  'taxon_bibreference' => 'Bibliographic Reference',
  'taxon_bibreference_hint' => 'Fill either the short bibliographic reference where the taxon was described, or select the registered reference from the dropdown. You may fill one or the other, but not both.',
  'hint_taxon_create' => 'Use this form to add a new Taxon to the database. After filling the taxon\'s name, the button "Check APIs" may be used to automatically fill most information. In order to register specialists, please use the Edit Person form.',
  'new_taxon' => 'New/Edit taxon',
  'taxon' => 'Taxon',
  'author' => 'Author',
  'level' => 'Level',
  'valid' => 'Valid',
  'valid_status' => 'Valid status',
  'taxons' => 'Taxonomy',
  'taxon_ancestors_and_children' => 'Related taxa',
  'name_error' => 'You need to fill in the name before proceeding',
  'mobot_error' => 'Error accessing MOBOT server',
  'mobot_not_found' => 'This name was not found on MOBOT servers',
  'geom_parent_error' => 'The coordinates for this location do not fall within the specified parent\'s coordinates, please check!',
  'unable_autodetect' => 'Unable to autodetect parent!',
  'isvalid' => 'Valid',
  'notvalid' => 'Invalid',
  'juniors' => 'Junior names',
  'accepted_name' => 'Accepted name',
  'registered_taxons' => 'Registered taxa',
  'taxon_parent_level_error' => 'The parent level should be strictly higher than the taxon level',
  'taxon_senior_level_error' => 'The senior level and the taxon level are too far apart',
  'taxon_senior_valid_error' => 'A name cannot be valid and have a senior synonym at the same time',
  'taxon_senior_invalid_error' => 'The indicated senior is marked as invalid in the database',
  'taxon_author_error' => 'You must provide an author name or select one in the dropdown, but not both.',
  'taxon_bibref_error' => 'You must provide a bibliographic reference or select one in the dropdown, but not both.',
  'senior_not_registered' => 'APIs indicate that this name is a junior synonym of :name, but this name is not registered in the database',
  'taxon_parent_species_error' => 'For subspecies, varieties and forms, the indicated parent must be a species',
  'taxon_parent_required_error' => 'It is necessary to specify a parent for all taxon levels greater than genus',
  'mobot_key' => 'MOBOT id number',
  'hint_mobot_key' => 'You may enter here the identification number of this taxon on the external sites. Most of the times, this will be auto-filled for you.',
);
