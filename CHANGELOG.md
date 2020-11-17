# [CHANGELOG](http://keepachangelog.com/)
All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

## [Unreleased]

## [0.4.0] - 2020-11-17

### Changed
- Updated to PSR-15

## [0.3.0] - 2017-09-25

### Added
- New request matchers for boolean composition:
  * `AndRequestMatcher`
  * `NegatedRequestMatcher`
  * `OrRequestMatcher`
- New request matchers for URI parts
  * `UriHostnameRegexRequestMatcher`
  * `UriPathRegexRequestMatcher`
  * `UriSchemeRequestMatcher`
- New `MethodRequestMatcher` to match request method

### Changed
- Renamed `AlwaysMatchRequestMatcher` to `AnyRequestMatcher`

### Deleted
- Removed `UriRegexRequestMatcher`

## [0.2.0] - 2017-09-20

### Changed
- Substitution of `Delegate` related code with `RequestHandler` to be compatible with
  http-interop/http-middleware:0.5

## [0.1.1] - 2017-07-17

### Added
- New request matcher `AlwaysMatchRequestMatcher`

## 0.1.0 - 2017-07-14

First release

[Unreleased]: https://github.com/ajgarlag/psr15-router/compare/0.4.0...master
[0.4.0]: https://github.com/ajgarlag/psr15-router/compare/0.3.0...0.4.0
[0.3.0]: https://github.com/ajgarlag/psr15-router/compare/0.2.0...0.3.0
[0.2.0]: https://github.com/ajgarlag/psr15-router/compare/0.1.1...0.2.0
[0.1.1]: https://github.com/ajgarlag/psr15-router/compare/0.1.0...0.1.1
