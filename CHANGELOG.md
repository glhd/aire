# Changelog

Starting with version 2.4.0, all notable changes will be documented in this file following
the [Keep a Changelog](https://keepachangelog.com/en/1.0.0/) format. This project adheres 
to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added

- Added Laravel 10 support

## [2.6.0] - 2022-08-08

### Added

-   Added support for bound attributes that are cast to an enum

## [2.5.0] - 2022-01-24

### Added

-   Added Laravel 9 support
-   Added support for registering a single mutator on multiple attributes
-   Added support for option groups

### Changed

-   Applied PHP-CS-Fixer code styles

## [2.4.5] - 2021-12-02

### Fixed

-   Fixed bug with [laravel-enum](https://github.com/BenSampo/laravel-enum) integration

## [2.4.4] - 2021-11-30

### Fixed

-   Addressed deprecation issues related to `ArrayAccess` return type in PHP 8.1

## [2.4.3] - 2021-06-18

### Fixed

-   Fixed casing issue with "datetime" blade components
-   Fixed issue with multiple forms on one page when using implicit opens

## [2.4.2] - 2021-04-13

### Added

-   Added `getBoundValue` annotation to facade
-   Added `hidden` attribute to `_token` and `_method` hidden inputs for better Tailwind 2 compatibility

## [2.4.1] - 2021-03-30

### Added

-   Added an `<x-aire::timezone-select />` component
-   Added a few missing annotations to the Aire facade

### Changed

-   Updated the way the Blade component namespace is registered for better auto-complete

## [2.4.0] - 2021-01-22

### Added

-   Added support for [Laravel Blade Components](https://laravel.com/docs/8.x/blade#components)

## 2.3.4 and before

For all releases from 2.3.4 and below, see the [Github Releases](https://github.com/glhd/aire/releases).

[Unreleased]: https://github.com/glhd/aire/compare/2.6.0...HEAD

[2.6.0]: https://github.com/glhd/aire/compare/2.5.0...2.6.0

[2.5.0]: https://github.com/glhd/aire/compare/2.4.5...2.5.0

[2.4.5]: https://github.com/glhd/aire/compare/2.4.4...2.4.5

[2.4.4]: https://github.com/glhd/aire/compare/2.4.3...2.4.4

[2.4.3]: https://github.com/glhd/aire/compare/2.4.2...2.4.3

[2.4.2]: https://github.com/glhd/aire/compare/2.4.1...2.4.2

[2.4.1]: https://github.com/glhd/aire/compare/2.4.0...2.4.1

[2.4.0]: https://github.com/glhd/aire/compare/2.3.4...2.4.0
