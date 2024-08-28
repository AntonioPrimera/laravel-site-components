<?php
namespace AntonioPrimera\SiteComponents\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Image extends Component
{
    public Media|null $image;

    public function __construct($section = null, $bit = null, $image = null)
    {
        if (!$section && !$bit && !$image)
            throw new \InvalidArgumentException('The image component requires a section, bit or image instance');

        $this->determineImageInstance($section, $bit, $image);
    }

    public function render(): View
    {
        return view('site::image');
    }

    //--- Protected helpers -------------------------------------------------------------------------------------------

    /**
     * Determine the image instance to use for this component
     * If the image is passed in the constructor, it will be used,
     * otherwise the image of the section will be used, if a section is passed,
     * otherwise the image of the bit will be used, if a bit is passed
     */
    protected function determineImageInstance($section, $bit, $image): Media|null
    {
        if ($image && $image instanceof Media)
            return $this->image = $image;

        if ($section)
            return $this->image = section($section)->image;
		
		if ($bit)
        	return $this->image = bit($bit)?->image;
		
		return null;
    }
}
