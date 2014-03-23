Installation
==========

Firstly, you need to have [composer][1] installed, therfor go to [it's download page], or download the [.exe installer][3] if you're using windows. Afterwards, make sure you have [git][4] installed on your machine, so composer is able to fetch the latest vendor dependencies.

Then go ahead to your command line (with **administrative privileges**, see below) and execute the following command:
```
php composer.phar create-project ntimo/animevideo [path] [version]
```
*(Version could be something like `0.1.0`, be sure to omit the `v`.)*

After installation you should be able to access it via `http://www.yourdomain.com/web/`.

*Why  do I need to install with adminstrative privileges?* During the installation composer generates some symlinks to the `src/` and `web/` directories, which need these privileges. I guarantee that this is the only use-case. 

[1]: https://getcomposer.org
[2]: https://getcomposer.org/download/
[3]: https://getcomposer.org/Composer-Setup.exe

[4]: http://git-scm.com/
