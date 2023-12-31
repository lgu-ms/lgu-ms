# lgu-ms

[![Build Deployment](https://github.com/lgu-ms/lgu-ms/actions/workflows/deployment.yml/badge.svg)](https://github.com/lgu-ms/lgu-ms/actions/workflows/deployment.yml)
[![CodeQL](https://github.com/lgu-ms/lgu-ms/actions/workflows/github-code-scanning/codeql/badge.svg)](https://github.com/lgu-ms/lgu-ms/actions/workflows/github-code-scanning/codeql)
[![PHP Composer](https://github.com/lgu-ms/lgu-ms/actions/workflows/php.yml/badge.svg)](https://github.com/lgu-ms/lgu-ms/actions/workflows/php.yml)

A comprehensive software solution designed to streamline and enhance the efficiency of LGU operations. This system integrates digital tools to facilitate transparent communication, automate administrative processes, and manage community resources, fostering a more responsive and connected governance structure.

- Link: https://digitalbarangay.com
- Uptime: https://stats.uptimerobot.com/n0EyAslx3A
- Project Table: https://github.com/orgs/lgu-ms/projects/2/views/1
- Project Module Table: https://github.com/orgs/lgu-ms/projects/1/views/1

<img src="animated-roped-off-construction-barracades.gif">

## Required Software
- XAMPP/LAMPP
- Composer
- NodeJS

## Contribute
- Forked this repository to your own Github Account
- Clone this repository to xampp/htdocs
```bash
git clone git@github.com:{username}/lgu-ms.git
```

## Install Dependencies
```bash
composer install --prefer-dist --no-progress
npm install
```

Open your [PHPMyAdmin](http://localhost/phpmyadmin) and create a database name `lgu-ms` and then import the `database/lgu-ms.sql` file followed by the importation of the rest of table files in the `database/` folder.

## PHP variables

- declare `masonry` to enable masonry script on the page
- declare `recaptcha` to enable reCAPTCHA script on the page
- declared `loadCustomJS` followed by the html script tage to be included after the `main.js`

## Contributions
Everyone is welcome to contribute on this public repository.

## License
License under MIT 
Copyright (c) 2023 Melvin Jones Repol & Its Contributors
```
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

```