# SiteTree Labeling
![Example SiteTree Label View](docs/demo-shot1.jpg)

Help to enrich your big and messy SiteTrees with some extra top-level information using labels.

Besides your custom labels the module will look for the [Menu Manager](https://github.com/heyday/silverstripe-menumanager) and auto-assign the MenuSet names to the Pages.

## Install
`composer require jzubero/silverstripe-sitetree-labels`

Do not forget to `dev/build?flush=all`.

## Dependencies
- ryanpotter/silverstripe-color-field:^0.1.0

## Features
- GridField in Settings for adding and linking labels
- Integration for Menu Manager Module
- Report for looking up pages linked to a certain label

## Customization
If you want to change the label look you can apply your custom style definitions to the class `.sitetree-label`. Default style:

```css
.sitetree-label {
    border-radius: 3px;
    font-size: 0.75rem;
    padding: 2px 4px;
    color: #fff;
    text-shadow: none;
}
```

## Maintainer
- JZubero <js@lvl51.de>