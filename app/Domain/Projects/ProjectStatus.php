<?php

namespace App\Domain\Projects;

enum ProjectStatus: string
{
    case Draft = 'draft';
    case Moderation = 'moderation';
    case Approved = 'approved';
    case Rejected = 'rejected';
}
