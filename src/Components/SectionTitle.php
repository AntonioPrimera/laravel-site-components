<?php
namespace AntonioPrimera\SiteComponents\Components;

use AntonioPrimera\Site\Models\Section;
use Illuminate\View\Component;
use Illuminate\View\View;

class SectionTitle extends Component
{
    public string $title;
    public int|string $level;

    public function __construct(Section|null $section = null, string|null $title = null, int|string $level = 2)
    {
        $this->title = $section ? $section->title : $title;
        $this->level = $level;
    }

    public function render(): View
    {
        return view('site::section-title');
    }
}
