# Changelog

Starting with version 2.4.0, all notable changes will be documented in this file following
the [Keep a Changelog](https://keepachangelog.com/en/1.0.0/) format. This project adheres 
to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [2.13.0] - 2024-09-18

## [2.12.1] - 2024-09-06

## [2.12.0] - 2024-08-13

## [2.11.0] - 2024-05-29

## [2.10.0] - 2024-03-12

## [2.9.1] - 2024-01-02

### Fixed

-   Fixed small bug in new JS validation logic

## [2.9.0] - 2023-12-29

### Changed

-   Updated Aire’s client-side validation JS to be less aggressive with marking errors 

## [2.8.1] - 2023-07-12

### Added

-   Added support for calling `isOpened()` on Aire to determine if any form is open

## [2.8.0] - 2023-05-12

### Added

-   Added backwards-compatible version of `Conditionable` helper to elements

## [2.7.0] - 2023-02-17

### Added

-   Added Laravel 10 support

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

[Unreleased]: https://github.com/glhd/aire/compare/2.13.0...HEAD

[2.13.0]: https://github.com/glhd/aire/compare/2.12.1...2.13.0

[2.12.1]: https://github.com/glhd/aire/compare/2.12.0...2.12.1

[2.12.0]: https://github.com/glhd/aire/compare/2.11.0...2.12.0

[2.11.0]: https://github.com/glhd/aire/compare/2.10.0...2.11.0

[2.10.0]: https://github.com/glhd/aire/compare/2.9.1...2.10.0

[2.9.1]: https://github.com/glhd/aire/compare/2.9.0...2.9.1

[2.9.0]: https://github.com/glhd/aire/compare/2.8.1...2.9.0

[2.8.1]: https://github.com/glhd/aire/compare/2.8.0...2.8.1

[2.8.0]: https://github.com/glhd/aire/compare/2.7.0...2.8.0

[2.7.0]: https://github.com/glhd/aire/compare/2.6.0...2.7.0

[2.6.0]: https://github.com/glhd/aire/compare/2.5.0...2.6.0

[2.5.0]: https://github.com/glhd/aire/compare/2.4.5...2.5.0

[2.4.5]: https://github.com/glhd/aire/compare/2.4.4...2.4.5

[2.4.4]: https://github.com/glhd/aire/compare/2.4.3...2.4.4

[2.4.3]: https://github.com/glhd/aire/compare/2.4.2...2.4.3

[2.4.2]: https://github.com/glhd/aire/compare/2.4.1...2.4.2

[2.4.1]: https://github.com/glhd/aire/compare/2.4.0...2.4.1

[2.4.0]: https://github.com/glhd/aire/compare/2.3.4...2.4.0
