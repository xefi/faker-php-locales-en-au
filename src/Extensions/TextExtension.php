<?php

namespace Xefi\Faker\EnAu\Extensions;

use Xefi\Faker\Extensions\TextExtension as BaseTextExtension;

class TextExtension extends BaseTextExtension
{
    /**
     * The extension locale.
     *
     * @return string|null
     */
    public function getLocale(): ?string
    {
        return 'en_AU';
    }

    protected array $paragraphs = [
        [
            ['Every', 'organisation', 'needs', 'a', 'clear', 'plan', 'before', 'the', 'new', 'financial', 'year', 'begins', 'in', 'July.'],
            ['Teams', 'across', 'the', 'country', 'analyse', 'their', 'results', 'and', 'share', 'what', 'they', 'have', 'learnt.'],
            ['Good', 'communication', 'keeps', 'regional', 'offices', 'connected', 'with', 'head', 'office.'],
            ['A', 'fair', 'go', 'for', 'every', 'staff', 'member', 'remains', 'part', 'of', 'the', 'culture.'],
        ],
        [
            ['The', 'service', 'centre', 'handles', 'enquiries', 'from', 'customers', 'in', 'every', 'state', 'and', 'territory.'],
            ['Staff', 'favour', 'practical', 'solutions', 'over', 'lengthy', 'reports.'],
            ['Feedback', 'is', 'gathered', 'regularly', 'so', 'that', 'the', 'program', 'can', 'improve', 'over', 'time.'],
            ['Small', 'changes', 'to', 'daily', 'routines', 'often', 'deliver', 'the', 'biggest', 'gains.'],
        ],
        [
            ['Labour', 'costs', 'and', 'travel', 'expenses', 'are', 'reviewed', 'at', 'the', 'end', 'of', 'each', 'quarter.'],
            ['Managers', 'prioritise', 'safety', 'on', 'every', 'site,', 'from', 'the', 'city', 'to', 'the', 'bush.'],
            ['Suppliers', 'are', 'chosen', 'for', 'their', 'reliability', 'as', 'much', 'as', 'their', 'price.'],
            ['The', 'catalogue', 'is', 'updated', 'whenever', 'a', 'new', 'licence', 'is', 'granted.'],
        ],
        [
            ['Training', 'helps', 'employees', 'build', 'skills', 'that', 'last', 'well', 'beyond', 'a', 'single', 'project.'],
            ['Mentors', 'encourage', 'graduates', 'to', 'ask', 'questions', 'and', 'take', 'initiative.'],
            ['Flexible', 'arrangements', 'allow', 'people', 'to', 'balance', 'work', 'with', 'family', 'and', 'sport.'],
            ['Positive', 'behaviour', 'is', 'recognised', 'and', 'celebrated', 'at', 'the', 'monthly', 'barbecue.'],
        ],
        [
            ['Reliable', 'data', 'supports', 'better', 'decisions', 'and', 'clearer', 'priorities.'],
            ['Targets', 'are', 'adjusted', 'when', 'market', 'conditions', 'change', 'unexpectedly.'],
            ['Regular', 'reviews', 'make', 'it', 'easier', 'to', 'respond', 'to', 'new', 'challenges.'],
            ['Customers', 'value', 'honest', 'advice', 'and', 'a', 'friendly', 'yarn.'],
            ['Long-term', 'growth', 'depends', 'on', 'steady', 'and', 'sustainable', 'progress.'],
        ],
    ];
}
