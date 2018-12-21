# PrestaShop 1.7 Extra customer field in PrestaShop 1.7 Module

Add extra customer field in PrestaShop 1.7.

==For PrestaShop Development training only.==

### Prerequisites

- You need a shop with **PrestaShop 1.7.0.0** or higher.
- You need access to the **shell** of your server.
- You need **composer**.

## Installing

To simplify the installation of the module files, we will use the [PrestaSpirit](https://prestaspirit.org) repository.

1. Add PrestaSpirit repository to your composer.json 
    ```sh
    $ cd prestashop_root_directory
    $ composer config repositories.prestaspirit composer https://prestaspirit.org
    ```
2. Install the module files in PrestaShop module directory
    ```sh
    $ composer require frederic-benoist/fbsample_extracustomerfield dev-master
    ```

3. Install the module with new PrestaShop command.

    ```sh
    cd prestashop_root_directory
    php bin/console prestashop:module install fbsample_extracustomerfield
    ```
    >`Use php `**`app/console`**` instead of php `**`bin/console`**` for versions prior to `**`1.7.4`**


## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/frederic-benoist/fbsample-extracustomerfield/tags). 

## Authors

* **Frédéric BENOIST** - *Initial work* - [Expert PrestaShop](https://www.fbenoist.com)

See also the list of [contributors](https://github.com/frederic-benoist/fbsample-extracustomerfield/Contributors) who participated in this project.

## Licensing

This source file is subject to the Academic Free License (AFL 3.0)
that is available through the world-wide-web at this URL:
http://opensource.org/licenses/afl-3.0.php
If you did not receive a copy of the license and are unable to
obtain it through the world-wide-web, please send an email
to license@prestashop.com so we can send you a copy immediately.

## DISCLAIMER
 
> Do not edit or add to this file if you wish to upgrade this module to newer versions in the future. If you wish to customize PrestaShop for your needs please refer to http://www.prestashop.com for more information.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
