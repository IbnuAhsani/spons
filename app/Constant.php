<?php

namespace App;

class Constant{
    const COMPANY_STATUS_AVAILABLE = 1;
    const COMPANY_STATUS_UNAVAILABLE = 0;

    const ROLE_STUDENT_INDIVIDUAL = 1;
    const ROLE_STUDENT_ORGANIZATION = 2;
    const ROLE_COMPANY = 3;

    const SPONSORSHIP_REQUEST_ACCEPTED = 1;
    const SPONSORSHIP_REQUEST_REJECTED = 0;
    const SPONSORSHIP_REQUEST_PENDING = 2;

    const EVENT_CATEGORY_TECHNOLOGY = 1;
    const EVENT_CATEGORY_BUSINESS = 2;
    const EVENT_CATEGORY_ART = 3;
    const EVENT_CATEGORY_SCIENCE = 4;
    const EVENT_CATEGORY_SOCIAL = 5;

    const EVENT_TYPE_SEMINAR = 1;
    const EVENT_TYPE_FESTIVAL = 2;
    const EVENT_TYPE_CONFERENCE = 3;
    const EVENT_TYPE_WORKSHOP = 4;
}
