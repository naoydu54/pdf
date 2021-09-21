<?php

namespace Ip\PdfBundle\Factory;

use Spipu\Html2Pdf\Html2Pdf;
use Symfony\Component\Config\Definition\Exception\Exception;

class IpPdfFactory
{
    private $defaultPage;
    private $pages;

    public function __construct($pages, $defaultPage)
    {
        $this->pages = $pages;
        $this->defaultPage = $defaultPage;
    }

    /**
     * @param string $page
     * @return Html2Pdf
     */
    public function create($page = null)
    {
        if(is_null($page)){
            $page = $this->defaultPage;
        }

        if(!isset($this->pages[$page])){
            throw new Exception(sprintf('Cannot find page in config for "%s" name', $page));
       }

       return new Html2Pdf(
           $this->pages[$page]['orientation'],
           $this->pages[$page]['format'],
           $this->pages[$page]['lang'],
           $this->pages[$page]['unicode'],
           $this->pages[$page]['encoding'],
           $this->pages[$page]['margin']
       );
    }
}