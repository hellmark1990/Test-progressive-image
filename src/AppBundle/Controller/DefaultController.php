<?php

namespace AppBundle\Controller;

use AppBundle\Utils\ProgressiveImages\ProgressiveManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $form = $this->createFormBuilder()
            ->add('image', 'file')// If I remove this line data is submitted correctly
            ->getForm();


        $imagesDir = __DIR__ . '/../../../web/images';
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            $file = $form->get('image')->getData();
            $name = $file->getClientOriginalName();
            (new ProgressiveManager())->processFile($file);
            /**
             * @var UploadedFile $file
             */
//            $path = $file->getRealPath();

//            $image = new \Imagick($path);
//            $image->setInterlaceScheme(\Imagick::INTERLACE_PNG);
//            $image->setInterlaceScheme(\Imagick::INTERLACE_JPEG);
//            $image->setImageCompression(\Imagick::COMPRESSION_JPEG);
//            $image->setImageCompressionQuality($image->getImageCompressionQuality());
//            $image->writeImage($dir . '/image.jpg');
//            $image->clear();
//            dump($path);exit;

//            $im = imagecreatefrompng($path);
//            $im = imagecreatefromjpeg($path);
//            imageinterlace($im, true);
//            imagepng($im, $path, 100, 1);
//            imagejpeg($im, $path, 100);
//            imagedestroy($im);


            $file->move($imagesDir, time() . "_" . $name);

        }
        $images = [];
        foreach (new \DirectoryIterator($imagesDir) as $file) {
            if (!$file->isDir())
                $images[] = $file->getBasename();
        }

        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir') . '/..'),
            'form' => $form->createView(),
            'images' => $images
        ));

    }


}
