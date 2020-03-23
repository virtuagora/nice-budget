<?php

namespace App\Action;

use App\Util\Exception\AppException;
use App\Util\Exception\UnauthorizedException;

class PageblockAction
{
    protected $pageblockResource;
    protected $options;
    protected $representation;
    protected $helper;
    protected $authorization;
    protected $db;
    protected $filesystem;
    protected $pagination;
    protected $view;

    public function __construct(
        $pageblockResource, $options, $representation, $helper, $authorization, $db, $filesystem, $pagination, $view
    ) {
        $this->pageblockResource = $pageblockResource;
        $this->options = $options;
        $this->representation = $representation;
        $this->helper = $helper;
        $this->authorization = $authorization;
        $this->db = $db;
        $this->filesystem = $filesystem;
        $this->pagination = $pagination;
        $this->view = $view;
    }
    public function showPageblocks($request, $response, $params)
    {
        $subject = $request->getAttribute('subject');
        if (!$this->authorization->checkPermission($subject, 'admin')) {
            throw new UnauthorizedException();
        }
        $blocks = $this->db->query('App:Pageblock')->get()->groupBy('path')->toArray();
        return $this->view->render($response, 'admin/configuration/pageblock-list.twig', [
            'blocks' => $blocks,
        ]);
    }

    
    public function showCreatePageblock($request, $response, $params)
    {
        $subject = $request->getAttribute('subject');
        if (!$this->authorization->checkPermission($subject, 'admin')) {
            throw new UnauthorizedException();
        }
        return $this->view->render($response, 'admin/configuration/pageblock-create.twig', []);
    }

    public function showEditPageblock($request, $response, $params)
    {
        $subject = $request->getAttribute('subject');
        if (!$this->authorization->checkPermission($subject, 'admin')) {
            throw new UnauthorizedException();
        }
        $block = $this->helper->getEntityFromId(
            'App:Pageblock', 'blo', $params
        );
        return $this->view->render($response, 'admin/configuration/pageblock-edit.twig', [
            'block' => $block
        ]);
    }
    public function showUploadPageblock($request, $response, $params)
    {
        $subject = $request->getAttribute('subject');
        if (!$this->authorization->checkPermission($subject, 'admin')) {
            throw new UnauthorizedException();
        }
        $block = $this->helper->getEntityFromId(
            'App:Pageblock', 'blo', $params
        );
        return $this->view->render($response, 'admin/configuration/pageblock-upload-picture.twig', [
            'block' => $block
        ]);
    }
    public function createOne($request, $response, $params)
    {
        $subject = $request->getAttribute('subject');
        if (!$this->authorization->checkPermission($subject, 'admin')) {
            throw new UnauthorizedException();
        }
        $this->pageblockResource->createOne($subject, $request->getParsedBody());
        return $this->representation->returnMessage($request, $response, [
            'message' => 'Pageblock creado exitosamente',
            'status' => 200,
        ]);
    }

    public function updateOne($request, $response, $params)
    {
        $subject = $request->getAttribute('subject');
        $pageblock = $this->helper->getEntityFromId(
            'App:Pageblock', 'blo', $params
        );
        if (!$this->authorization->checkPermission($subject, 'admin')) {
            throw new UnauthorizedException();
        }
        $data = $request->getParsedBody();
        $pageblock = $this->pageblockResource->updateOne($subject, $pageblock, $data);
        return $this->representation->returnMessage($request, $response, [
            'message' => 'Información del proyecto actualizada exitosamente',
            'status' => 200
        ]);
    }

    public function deleteOne($request, $response, $params)
    {
        $subject = $request->getAttribute('subject');
        $pageblock = $this->helper->getEntityFromId(
            'App:Pageblock', 'blo', $params
        );
        if (!$this->authorization->checkPermission($subject, 'admin')) {
            throw new UnauthorizedException();
        }
        $this->pageblockResource->deleteOne($subject, $pageblock);
        return $this->representation->returnMessage($request, $response, [
            'message' => 'Pageblock eliminado exitosamente',
            'status' => 200,
        ]);
    }

    public function runUploadImage($request, $response, $params)
    {
        $subject = $request->getAttribute('subject');
        $pageblock = $this->helper->getEntityFromId(
            'App:Pageblock', 'blo', $params
        );
        if (!$this->authorization->checkPermission($subject, 'admin')) {
            throw new UnauthorizedException();
        }
        if (empty($request->getUploadedFiles()['archivo'])) {
            throw new AppException('No se envió un archivo');
        }
        $file = $request->getUploadedFiles()['archivo'];
        $this->pageblockResource->uploadImage($subject, $pageblock, $file);
        return $response->withRedirect($request->getHeaderLine('HTTP_REFERER'));
    }
    
    public function showImage($request, $response, $params)
    {
        $path = 'pageblock/' . $this->helper->getSanitizedId('blo', $params) . '.jpg';
        if (!$this->filesystem->has($path)) {
            throw new \App\Util\Exception\AppException(
                'El documento no se encuentra almacenado', 404
            );
        }
        return $response
            ->withBody(new \Slim\Http\Stream($this->filesystem->readStream($path)))
            ->withHeader('Content-Type', $this->filesystem->getMimetype($path));
    }
}