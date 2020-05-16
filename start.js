/*

This is a custom front end build solution that I wrote to make front-end development quicker.

It simply watches the ./view folder for changes and renders the contents to the public folder.
I utilize Pug as a markup preprocessor because I find it to be less prone to errors and more readable.

This build system also watches the ./style folder and renders any .scss files as compressed .css in
the public folder.

This script will start a php development server with the root in the public folder @ localhost:3000

*/

const { exec } = require('child_process')
const fs = require('fs')
const chokidar = require('chokidar')
const pug = require('pug')
const sass = require('sass')

chokidar.watch('./view/').on('all', function(event, path)
{
    path = path.split('/')

    if (path.length == 2)
    {
        if (fs.existsSync('./view/index.pug'))
            fs.writeFileSync('./public/index.php', pug.renderFile('./view/index.pug'))
    }
    else if (path.length == 3)
    {
        if (fs.existsSync('./view/' + path[1] + '/index.pug'))
        {
            if (!fs.existsSync('./public/' + path[1] + '/'))
                fs.mkdirSync('./public/' + path[1] + '/')
            fs.writeFileSync('./public/' + path[1] + '/index.php', pug.renderFile('./view/' + path[1] + '/index.pug'))
        }
    }
})

chokidar.watch('./style/').on('all', function(event, path)
{
    if (path.endsWith('.scss'))
    {
        path = path.split('/')[1].split('.')[0]
        fs.writeFileSync('./public/' + path + '.css', sass.renderSync({file:'./style/' + path + '.scss', outputStyle:"compressed"}).css.toString())
    }
})

exec('php -S localhost:3000 -t public/')
console.log('Server started.')