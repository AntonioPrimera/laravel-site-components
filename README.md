# Useful reusable components for laravel sites

[![Latest Version on Packagist](https://img.shields.io/packagist/v/antonioprimera/laravel-site-components.svg?style=flat-square)](https://packagist.org/packages/antonioprimera/laravel-site-components)

This package provides a set of useful reusable components for laravel sites, based on the
[antonioprimera/larave-site](https://github.com/AntonioPrimera/laravel-site) package.

The laravel-site package introduces the Site, Page, Section and Bit models, which hold the contents of a site.
The laravel-site package is view agnostic, and only provides abstract view component classes, used to build concrete
view components.

This package provides some useful prebuilt components, that you can use in your site.

## Installation

You can install the package via composer:

```bash
composer require antonioprimera/laravel-site-components
```

## Prebuilt components

The package provides a set of prebuilt components that you can use in your site. The prebuilt components are
focused on handling the rendering of sections and bits (see the
[antonioprimera/larave-site](https://github.com/AntonioPrimera/laravel-site) package for more information on sections
and bits).

### SectionContainer

This is a simple container component, providing a responsive layout for sections, with a max width and some horizontal
padding. It does not have any props. It comes with some default tailwind classes for styling, but you can override the
styling by creating a 'section-container' class in your css.

```html
<x-site-section-container>
    <!-- Your section content here -->
</x-site-section-container>
```

### SectionTitle

This is a title component for a section, rendering a heading tag with the section title. The component has no styling.
You can style it, by defining a 'section-title' class in your css.

Props:
- title (string): the title of the section (optional) (at least one of title or section must be provided)
- section (Section): the section model instance (optional) (the section has precedence over the string title)
- level (int|string): the heading level (default: 2)

```html
<x-site-section-title title="{{ $section->title }}"/>
<!-- or -->
<x-site-section-title :section="$section"/>
<!-- or with a specific heading level -->
<x-site-section-title :section="$section" level="3"/>
```

### Image

This is an image component, rendering a responsive spatie media model. The component accepts a media model, a section
model or a bit model as a prop. The component has no styling. You can style it, by defining a 'site-image' class
in your css. If the media model is not provided, the component will render a placeholder svg image.

Props:
- media (Media): the media model instance (optional) (at least one of media, section or bit must be provided)
- section (Section): the section model instance (optional) (the image of the section will be rendered - if any)
- bit (Bit): the bit model instance (optional) (the image of the bit will be rendered - if any)

```html
<x-site-image :media="$media"/>
<!-- or -->
<x-site-image :section="$section"/>
<!-- or -->
<x-site-image :bit="$bit"/>
```

### Nav

This is a basic navigation component, rendering a responsive site nav bar. The component accepts a NavItemCollection
as a prop (a collection of NavItem instances). The component has some basic styling, but you can style it, by publishing
the css file and overriding the default styles.

Props:
- items (NavItemCollection|array): a collection of `AntonioPrimera\SiteComponents\ViewModels\NavItem` instances

Alternatively, you can inherit the Nav component class and override the navItems() method, to provide the navigation
items for the nav bar.

```html
<x-site-nav :items="$navItems"/>
<!-- or, if you inherited the Nav class, in a local View/Components/Nav class and defined the navItems inside -->
<x-nav/>
```

## Contributing

Feel free to contribute to this package by creating a pull request. Just please keep in mind the following guidelines:
- Follow the Laravel coding style
- Write tests for your code (if applicable) and make sure they pass
- Document your code and update the README.md file
- Keep the package simple and focused on the main goal: providing reusable components for laravel websites

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
