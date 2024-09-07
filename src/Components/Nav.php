<?php
namespace AntonioPrimera\SiteComponents\Components;

use AntonioPrimera\SiteComponents\ViewModels\NavItemCollection;
use Illuminate\View\Component;
use Illuminate\View\View;

abstract class Nav extends Component
{
	public NavItemCollection $items;
	protected string $viewName = 'site::nav';
	
    public function __construct()
    {
		$this->items = $this->navItems();
    }

    public function render(): View
    {
        return view($this->viewName);
    }
	
	/**
	 * Define your nav items here
	 */
	abstract protected function navItems(): NavItemCollection;
}
