<?php

namespace AppBundle\Controller;

//use Imagick;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Snowcap\ImBundle\Manager;
use Snowcap\ImBundle\Wrapper;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {

        $form = $this->createFormBuilder()
            ->add('image', 'file')// If I remove this line data is submitted correctly
            ->getForm();


        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            $file = $form->get('image')->getData();
            $name = $file->getClientOriginalName();
            /**
             * @var UploadedFile $file
             */
            $path = $file->getRealPath();
            $dir = __DIR__ . '/../../../web';


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

//            $file->move($dir, 'image.jpg');
//            $file->move($dir, 'image.png');

        }
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir') . '/..'),
            'form' => $form->createView(),
        ));

    }


}
