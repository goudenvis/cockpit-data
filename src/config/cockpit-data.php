<?php
/*
 * Configuration for the Cockpit Data extraction
 * Use:
 *  'CockpitDataTable' => [
 *      'class'   => 'CockpitDataClassName', //Classname without the full namespace
 *      'internal_database => 'local_database_name' //Optional. Use for pivottables, without model
 *      'columns' => [
 *              'cockpitColumnName' => 'database_table_name'
 *      ]
 * ]
 */

return [
    'CandidateMatchfields' => [
        'class' => '',
        'internal_database' => 'cockpit_data_candidate_matchfield',
        'columns' => [
            'Id'=> 'id',
            'CandidateId' => 'candidate_id',
            'MatchfieldId' => 'matchfield_id',
        ]
    ],
    'CandidateNotes' => [
        'class' => 'CandidateNote',
        'internal_database' => 'cockpit_data_candidate_notes',
        'history' => 30,
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
    'CandidateProposalStateTransitions' => [
        'class' => 'CandidateProposalStateTransition',
        'history' => 30,
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
    'CandidateStateTransitions' => [
        'class' => 'CandidateStateTransition',
        'history' => 30,
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
    'CandidateProposals' => [
        'class' => '',
        'internal_database' => 'cockpit_data_candidate_proposal',
        'unique_id' => 'candidate_proposal_id',
        'columns' => [
            'Id'=> 'id',
            'CandidateProposalId' => 'candidate_proposal_id',
            'CandidateId' => 'candidate_id',
            'CompanyId' => 'company_id',
            'CompanyContactPersonId' => 'company_contact_person_id',
        ]
    ],
    'Candidates' => [
        'class' => 'Candidate',
        'history' => 30,
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
        ]
    ],
    'Companies' => [
        'class' => 'Company',
        'unique_id' => 'company_id',
        'columns' => [
            'Id'=> 'id',
            'CompanyId' => 'company_id',
            'Name' => 'name',
            'RemoteId' => 'remote_id'
        ]
    ],
    'CompanyContactNotes' => [
        'class' => 'CompanyContactNote',
        'history' => 30,
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
    'CompanyContactPersons' => [
        'class' => 'CompanyContactPerson',
        'unique_id' => 'company_contact_person_id',
        'columns' => [
            'Id'=> 'id',
            'CompanyContactPersonId' => 'company_contact_person_id',
            'Name' => 'name',
            'RemoteId' => 'remote_id'
        ]
    ],
    'Company_CompanyContactPerson' => [
        'class' => '',
        'internal_database' => 'cockpit_data_company_company_contact_person',
        'columns' => [
            'Id'=> 'id',
            'CompanyId' => 'company_id',
            'CompanyContactPersonId' => 'company_contact_person_id',
        ]
    ],
    'Departments' => [
        'class' => 'Department',
        'unique_id' => 'department_id',
        'columns' => [
            'Id'=> 'id',
            'DepartmentId' => 'department_id',
            'Name' => 'name',
            'RemoteId' => 'remote_id'
        ]
    ],
    'MatchStateTransitions' => [
        'class' => 'MatchStateTransition',
        'history' => 30,
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
    'Matches' => [
        'class' => 'Match',
        'history' => 30,
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
    'MatchFields' => [
        'class' => 'MatchField',
        'columns' => [
            'Id'=> 'id',
            'MatchFieldId' => 'match_id',
            'Name' => 'name',
            'Value' => 'value',
        ]
    ],
    'Users' => [
        'class' => 'User',
        'unique_id' => 'user_id',
        'columns' => [
            'Id'=> 'id',
            'UserId' => 'user_id',
            'FirstName' => 'first_name',
            'LastName' => 'last_name',
            'RemoteId' => 'remote_id'
        ]
    ],
    'Vacancies' => [
        'class' => 'Vacancy',
        'history' => 30,
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
    'VacancyKnockoutQuestions' => [
        'class' => 'VacancyKnockoutQuestion',
        'columns' => [
            'Id'=> 'id',
            'VacancyId' => 'vacancy_id',
            'KnockoutQuestionId' => 'knockout_question_id',
            'Name' => 'name',
        ]
    ],
    'VacancyNotes' => [
        'class' => 'VacancyNote',
        'history' => 30,
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
    'VacancyStateTransitions' => [
        'class' => 'VacancyStateTransition',
        'history' => 30,
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
