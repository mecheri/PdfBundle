# PDFBundle
The Siphoc PDF Bundle provides an easy way to create PDF's from your views.

[![Build Status](https://travis-ci.org/siphoc/PdfBundle.png?branch=master)](https://travis-ci.org/siphoc/PdfBundle)

## Installation

### Step 1: Download the bundle using Composer
Add SiphocPdfBundle to composer.

    {
        "require": {
            "siphoc/pdf-bundle": "1.0.*"
        }
    }

Install the bundle:

    $ composer.phar update siphoc/pdf-bundle

Composer will install the bundle with the required dependencies.

### Step 2: Enable the bundle
In your AppKernel add the following:

    <?php
    // app/AppKernel.php

    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Siphoc\PdfBundle\SiphocPdfBundle(),
        );
    }

### Step 3: configure your bundle
In your config.yml file:

    siphoc_pdf:
        basepath: "%kernel.root_dir%/../web"
        binary: "/usr/local/bin/wkhtmltopdf"
        options:
            'lowquality': false
            'enable-javascript': true
            'debug-javascript': true

## Usage

In your controller, you can download the contents of your controller like this:

    $html = $this->renderView(
        'AcmeDemoBundle:Demo:index.html.twig', array(
            'name' => $name,
        )
    );

    $pdfGenerator = $this->get('siphoc.pdf.generator');

    return new Response(
        $pdfGenerator->getOutputFromHtml($html),
        200,
        array(
            'Content-Type'          => 'application/pdf',
            'Content-Disposition'   => 'attachment; filename="file.pdf"'
        )
    );

In the future, I'll provide a way that you can skip the $this->renderView() and
new Response() part. It'll create a response depending on your view and
paramameters. For now, this is the way to go.

## Documentation
The main Documentation can be found in Resources/doc/index.html. It is
auto-generated by PHPDocumentor2. The directory itself is excluded trough git
because we use the [PHPDoc Markdown](https://github.com/evert/phpdoc-md) plugin
to create proper MD files to include in Git.

If you want to contribute, be sure to update the documentation and run both
[PHPDocumentor2](http://www.phpdoc.org/) and PHPDoc Markdown.
This way the documentation keeps up to date properly.

## Tests
For tests I've used PHPUnit. Contributions need to be supported with tests.

## License
This bundle is under the MIT License.

## Dependencies

### Buzz
For external calls, I've included the [Buzz](https://github.com/kriswallsmith/Buzz)
Bundle from [@kriswallsmith](https://github.com/kriswallsmith).

### Snappy
To create the actual PDF. We're using [Snappy](https://github.com/knplabs/snappy).
This has the [wkhtmltopdf](http://code.google.com/p/wkhtmltopdf/) dependency. Be
sure that you use the latest version (>=0.11.0_rc1).
