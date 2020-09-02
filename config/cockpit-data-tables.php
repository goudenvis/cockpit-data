<?php
/*
 * Configuration for the Cockpit Data extraction
 * Use:
 *  [
 *      'cockpit_table_name => 'Vacancies', //Tablename used by Cockpit
 *      'class'   => 'CockpitDataClassName', //Classname without the full namespace
 *      'pivot' => //Optional. Use for tables without Datetime_created column.
 *      'columns' => [
 *              'CockpitColumnName' => 'database_table_name'
 *      ]
 * ]
 */

return [
    [
        'cockpit_table_name' => 'Tasks',
        'class' => 'CockpitDataTask',
        'columns' => [
            'Id'=> 'id',
            'TaskId' => 'task_id',
            'DocumentLinkId' => 'document_link_id',
            'SubDocumentLinkId' => 'sub_document_link_id',
            'DueDate' => 'due_date',
            'Title' => 'title',
            'Description' => 'discription',
            'IsDone' => 'is_done',
            'StatusId' => 'status_id',
            'StatusName' => 'status_name',
            'SubjectId' => 'subject_id',
            'SubjectName' => 'subject_name',
            'OwnerId' => 'owner_id',
            'OwnerDepartmentId' => 'owner_department_id'
        ]
    ],
    [
        'cockpit_table_name' => 'CandidateMatchFields',
        'class' => 'CockpitDataCandidateMatchField',
        'pivot' => true,
        'columns' => [
            'Id'=> 'id',
            'CandidateId' => 'candidate_id',
            'MatchfieldId' => 'matchfield_id',
        ]
    ],
    [
        'cockpit_table_name' => 'VacancyMatchFields',
        'class' => 'CockpitDataVacancyMatchField',
        'pivot' => true,
        'columns' => [
            'Id'=> 'id',
            'VacancyId' => 'vacancy_id',
            'MatchfieldId' => 'matchfield_id',
        ]
    ],
    [
        'cockpit_table_name' => 'CandidateNotes',
        'class' => 'CockpitDataCandidateNote',
        'columns' => [
            'Id'=> 'id',
            'CandidateId' => 'candidate_id',
            'NoteId' => 'note_id',
            'Category' => 'category',
            'SubCategory' => 'sub_category',
            'AuthorId' => 'author_id',
            'DatetimeCreated' => 'datetime_created',
        ]
    ],
    [
        'cockpit_table_name' => 'CandidateCustomCharacteristics',
        'class' => 'CockpitDataCandidateCustomCharacteristic',
        'columns' => [
            'Id'=> 'id',
            'CandidateId' => 'candidate_id',
            'CustomCharacteristicsCategoryId' => 'custom_characteristics_category_id',
            'Category' => 'custom_characteristic',
            'SubCategory' => 'value',
        ]
    ],
    [
        'cockpit_table_name' => 'CandidateCustomCharacteristicCategories',
        'class' => 'CockpitDataCandidateCustomCharacteristicCategory',
        'columns' => [
            'Id'=> 'id',
            'CustomCharacteristicsCategoryId' => 'custom_characteristics_category_id',
            'Name' => 'name',
            'IsDeleted' => 'is_deleted',
            'ParentCategoryId' => 'parent_category_id',
        ]
    ],
    [
        'cockpit_table_name' => 'VacancyCustomCharacteristics',
        'class' => 'CockpitDataVacancyCustomCharacteristic',
        'columns' => [
            'Id'=> 'id',
            'VacancyId' => 'vacancy_id',
            'CustomCharacteristicsCategoryId' => 'custom_characteristics_category_id',
            'Category' => 'custom_characteristic',
            'SubCategory' => 'value',
        ]
    ],
    [
        'cockpit_table_name' => 'CompanyCustomCharacteristics',
        'class' => 'CockpitDataCompanyCustomCharacteristic',
        'columns' => [
            'Id'=> 'id',
            'CompanyId' => 'company_id',
            'CustomCharacteristicsCategoryId' => 'custom_characteristics_category_id',
            'Category' => 'custom_characteristic',
            'SubCategory' => 'value',
        ]
    ],
    [
        'cockpit_table_name' => 'CandidateProposalStateTransitions',
        'class' => 'CockpitDataCandidateProposalStateTransition',
        'columns' => [
            'Id'=> 'id',
            'CandidateProposalId' => 'candidate_proposal_id',
            'BeforeState' => 'before_state',
            'AfterState' => 'after_state',
            'Reasons' => 'reasons',
            'AuthorId' => 'author_id',
            'DatetimeCreated' => 'datetime_created',
            'SystemGenerated' => 'system_generated',
        ]
    ],
    [
        'cockpit_table_name' => 'CandidateStateTransitions',
        'class' => 'CockpitDataCandidateStateTransition',
        'columns' => [
            'Id'=> 'id',
            'CandidateId' => 'candidate_id',
            'BeforeState' => 'before_state',
            'AfterState' => 'after_state',
            'Reasons' => 'reasons',
            'AuthorId' => 'author_id',
            'DatetimeCreated' => 'datetime_created',
            'SystemGenerated' => 'system_generated',
        ]
    ],
    [
        'cockpit_table_name' => 'CandidateProposals',
        'pivot' => true,
        'class' => 'CockpitDataCandidateProposal',
        'unique_id' => 'candidate_proposal_id',
        'columns' => [
            'Id'=> 'id',
            'CandidateProposalId' => 'candidate_proposal_id',
            'CandidateId' => 'candidate_id',
            'CompanyId' => 'company_id',
            'CompanyContactPersonId' => 'company_contact_person_id',
        ]
    ],
    [
        'cockpit_table_name' => 'Candidates',
        'class' => 'CockpitDataCandidate',
        'unique_id' => 'candidate_id',
        'columns' => [
            'Id'=> 'id',
            'CandidateId' => 'candidate_id',
            'RemoteId' => 'remote_id',
            'OwnerId' => 'owner_id',
            'OwnerDepartmentId' => 'owner_department_id',
            'Name' => 'name',
            'FirstName' => 'first_name',
            'MiddleName' => 'middle_name',
            'LastName' => 'last_name',
            'Email' => 'email_address',
            'AuthorId' => 'author_id',
            'AuthorDepartmentId' => 'author_department_id',
            'DateTimeCreated' => 'datetime_created',
            'DateTimeModified' => 'datetime_modified',
            'Referral' => 'referral',
            'Origin' => 'origin',
            'IsDeleted' => 'is_deleted',
            'DateTimeDeleted' => 'datetime_deleted',
            'CommunicationPreferedLanguage' => 'communication_prefered_language'
        ]
    ],
    [
        'cockpit_table_name' => 'Companies',
        'class' => 'CockpitDataCompany',
        'unique_id' => 'company_id',
        'columns' => [
            'Id'=> 'id',
            'CompanyId' => 'company_id',
            'Name' => 'name',
            'RemoteId' => 'remote_id',
            'OwnerDepartmentId' => 'owner_department_id',
            'AuthorId' => 'author_id',
            'AuthorDepartmentId' => 'author_department_id',
            'DatetimeCreated' => 'datetime_created',
            'DatetimeModified' => 'datetime_modified',
            'IsDeleted' => 'is_deleted',
            'DatetimeDeleted' => 'datetime_deleted',

        ]
    ],
    [
        'cockpit_table_name' => 'CompanyContactNotes',
        'class' => 'CockpitDataCompanyContactNote',
        'unique_id' => 'company_contact_id',
        'columns' => [
            'Id'=> 'id',
            'CompanyContactId' => 'company_contact_id',
            'CompanyId' => 'company_id',
            'NoteId' => 'note_id',
            'Category' => 'category',
            'SubCategory' => 'sub_category',
            'AuthorId' => 'author_id',
            'DatetimeCreated' => 'datetime_created',
        ]
    ],
    [
        'cockpit_table_name' => 'CompanyContactPersons',
        'class' => 'CockpitDataCompanyContactPerson',
        'unique_id' => 'company_contact_person_id',
        'columns' => [
            'Id'=> 'id',
            'CompanyContactPersonId' => 'company_contact_person_id',
            'Name' => 'name',
            'RemoteId' => 'remote_id',
            'OwnerId' => 'owner_id',
            'OwnerDepartmentId' => 'owner_department_id',
            'AuthorId' => 'author_id',
            'AuthorDepartmentId' => 'author_department_id',
            'DatetimeCreated' => 'datetime_created',
            'DatetimeModified' => 'datetime_modified',
            'IsDeleted' => 'is_deleted',
            'DatetimeDeleted' => 'datetime_deleted',
        ]
    ],
    [
        'cockpit_table_name' => 'Company_CompanyContactPerson',
        'class' => 'CockpitDataCompanyCompanyContactPerson',
        'pivot' => true,
        'columns' => [
            'Id'=> 'id',
            'CompanyId' => 'company_id',
            'CompanyContactPersonId' => 'company_contact_person_id',
        ]
    ],
    [
        'cockpit_table_name' => 'Departments',
        'class' => 'CockpitDataDepartment',
        'unique_id' => 'department_id',
        'columns' => [
            'Id'=> 'id',
            'DepartmentId' => 'department_id',
            'Name' => 'name',
            'RemoteId' => 'remote_id'
        ]
    ],
    [
        'cockpit_table_name' => 'MatchStateTransitions',
        'class' => 'CockpitDataMatchStateTransition',
        'columns' => [
            'Id'=> 'id',
            'MatchId' => 'match_id',
            'DatetimeCreated' => 'datetime_created',
            'SystemGenerated' => 'system_generated',
            'AuthorId' => 'author_id',
            'BeforeState' => 'before_state',
            'AfterState' => 'after_state',
            'Reasons' => 'reasons',
            'Data' => 'datetime',
        ]
    ],
    [
        'cockpit_table_name' => 'Matches',
        'class' => 'CockpitDataMatch',
        'unique_id' => 'match_id',
        'columns' => [
            'Id'=> 'id',
            'MatchId' => 'match_id',
            'RemoteId' => 'remote_id',
            'VacancyId' => 'vacancy_id',
            'CandidateId' => 'candidate_id',
            'OwnerId' => 'owner_id',
            'OwnerDepartmentId' => 'owner_department_id',
            'DatetimeCreated' => 'datetime_created',
            'MatchSourceType' => 'match_source_type',
            'GoogleAnalyticsSessionId' => 'google_analytics_session_id',
            'GoogleAnalyticsUserId' => 'google_analytics_user_id',
            'UtmSource' => 'utm_source',
            'UtmMedium' => 'utm_medium',
            'UtmCampaign' => 'utm_campaign',
            'UtmTerm' => 'utm_term',
            'UtmContent' => 'utm_content',
            'TrackingFields' => 'tracking_fields',
        ]
    ],
    [
        'cockpit_table_name' => 'MatchFields',
        'class' => 'CockpitDataMatchField',
        'columns' => [
            'Id'=> 'id',
            'MatchFieldId' => 'match_id',
            'Name' => 'name',
            'Value' => 'value',
        ]
    ],
    [
        'cockpit_table_name' => 'Users',
        'class' => 'CockpitDataUser',
        'unique_id' => 'user_id',
        'columns' => [
            'Id'=> 'id',
            'UserId' => 'user_id',
            'FirstName' => 'first_name',
            'MiddleName' => 'middle_name',
            'LastName' => 'last_name',
            'RemoteId' => 'remote_id'
        ]
    ],
    [
        'cockpit_table_name' => 'Vacancies',
        'class' => 'CockpitDataVacancy',
        'unique_id' => 'id',
        'columns' => [
            'Id'=> 'id',
            'VacancyId' => 'vacancy_id',
            'OwnerId' => 'owner_id',
            'OwnerDepartmentId' => 'owner_department_id',
            'Title' => 'title',
            'CreationReason' => 'creation_reason',
            'IsAdvertisable' => 'is_advertisable',
            'AuthorId' => 'author_id',
            'DatetimeCreated' => 'datetime_created',
            'DatetimeModified' => 'datetime_modified',
            'StartDate' => 'start_date',
            'EndDate' => 'end_date',
            'CompanyId' => 'company_id',
            'CompanyContactPersonId' => 'company_contact_person_id',
            'MaxAllowedApplications' => 'max_allowed_applications',
            'CvRequired' => 'cv_required',
            'TotalHiredCandidatesWanted' => 'total_hired_candidates_wanted',
            'WorkingHoursMin' => 'working_hours_min',
            'WorkingHoursMax' => 'working_hours_max',
        ]
    ],
    [
        'cockpit_table_name' =>'VacancyKnockoutQuestions',
        'class' => 'CockpitDataVacancyKnockoutQuestion',
        'columns' => [
            'Id'=> 'id',
            'VacancyId' => 'vacancy_id',
            'KnockoutQuestionId' => 'knockout_question_id',
            'Name' => 'name',
        ]
    ],
    [
        'cockpit_table_name' => 'VacancyNotes',
        'class' => 'CockpitDataVacancyNote',
        'unique_id' => 'note_id',
        'columns' => [
            'Id'=> 'id',
            'VacancyId' => 'vacancy_id',
            'NoteId' => 'note_id',
            'Category' => 'category',
            'SubCategory' => 'sub_category',
            'AuthorId' => 'author_id',
            'DatetimeCreated' => 'datetime_created',
        ]
    ],
    [
        'cockpit_table_name' => 'VacancyStateTransitions',
        'class' => 'CockpitDataVacancyStateTransition',
        'columns' => [
            'Id'=> 'id',
            'VacancyId' => 'vacancy_id',
            'DatetimeCreated' => 'datetime_created',
            'SystemGenerated' => 'system_generated',
            'AuthorId' => 'author_id',
            'BeforeState' => 'before_state',
            'AfterState' => 'after_state',
            'Reasons' => 'reasons',
        ]
    ],
];
