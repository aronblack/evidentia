# Tokoo Starter #


### Requirement? ###

* [Node](https://nodejs.org/en/)
* WordPress Installation with MAMP/Vagrant with hosts set to `theme.dev`

### How do I get set up? ###

* [Download This Repo](https://bitbucket.org/tokokoo/tokoo-starter/downloads)
* Extract/place it in `themes` folder
* Rename the folder to Theme name
* Open terminal and navigate to the folder
* type `npm install` to install all dependency
* Open `gulpfile.js`, Update the `project` variable to theme name folder.

### How to Use ###

* [Back End] In terminal you can start the task by typing `gulp watch` or just `gulp`
* [Front End] start frontend task by typing `gulp frontend`. This will start watching `source/jade` and compile it to `source/html`.
* When the watching task started it will open `localhost:port`, stick to that url, don't use theme.dev for Browser Sync to work.
* [Front End] if you want to access the `app/assets/` folder you just need to type it like so, there no need to add `../../`
* For Bundling the theme, terminate the watch task `cmd+c` and start bundle task `gulp bundle`

### Technology Used? ###

* [Gulp Streaming Build System](http://gulpjs.com/)
* [BrowserSync](browsersync.io) for live reloading and browser syncing in all devices
* Plugins : `gulp-autoprefixer`, `gulp-sass`, `gulp-combine-media-queries`, `gulp-csscomb`, `gulp-sourcemaps`, `gulp-uglifycss`, `gulp-jade`, `jshint`, `jshint-stylish`, `gulp-jshint`, `gulp-uglify`, `gulp-concat`, `gulp-ignore`, `gulp-image`, `gulp-newer`, `gulp-notify`, `gulp-rename`, `gulp-rimraf`, `gulp-watch`, `gulp-zip`, `run-sequence`

### Tips
For saving disk space, you can install all npm dependency globally once, then you can link the libs within your new project folder.

```
#!terminal

npm install -g browser-sync gulp gulp-autoprefixer gulp-combine-media-queries gulp-concat gulp-csscomb gulp-ignore gulp-image gulp-jade gulp-jshint gulp-newer gulp-notify gulp-rename gulp-rimraf gulp-sass gulp-sourcemaps gulp-uglify gulp-uglifycss gulp-watch gulp-zip jshint jshint-stylish run-sequence

```
For linking libs
```
#!terminal

npm link browser-sync gulp gulp-autoprefixer gulp-combine-media-queries gulp-concat gulp-csscomb gulp-ignore gulp-image gulp-jade gulp-jshint gulp-newer gulp-notify gulp-rename gulp-rimraf gulp-sass gulp-sourcemaps gulp-uglify gulp-uglifycss gulp-watch gulp-zip jshint jshint-stylish run-sequence

```

You may use sudo for linking jshint by the way.