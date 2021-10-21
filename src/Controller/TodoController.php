<?php

namespace App\Controller;
    
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TaskRepository;
use App\Entity\Task;
use Symfony\Component\HttpFoundation\Request;
    
class TodoController extends AbstractController
{
    private $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @Route("/{reactRouting}", name="home", defaults={"reactRouting": null})
     */
    public function index()
    {
        return $this->render('default/index.html.twig');
    }

    /**
    * @Route("/api/todolist", name="get_all_tasks")
    * @return \Symfony\Component\HttpFoundation\JsonResponse
    */
    public function getAll()
    {
        $tasks = $this->taskRepository->getAll();
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->setContent(json_encode($tasks));
        return $response;
    }

    /**
    * @Route("/api/todolist/{id}", name="get_detail_task", requirements={"id"="\d+"})
    * @return \Symfony\Component\HttpFoundation\JsonResponse
    */
    public function getDetail(int $id)
    {
        $task = $this->taskRepository->getDetail($id);
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->setContent(json_encode($task));
        return $response;
    }

    /**
    * @Route("/api/todolist/delete/{id}", name="delete_task")
    * @return \Symfony\Component\HttpFoundation\JsonResponse
    */
    public function delete(int $id)
    {
        $this->taskRepository->delete($id);
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->setContent('Delete Successful');
        return $response;
    }

    /**
    * @Route("/api/todolist/update", name="update_task")
    * @return \Symfony\Component\HttpFoundation\JsonResponse
    */
    public function update(Request $request)
    {   
        $id = $request->query->get('id') > -1 ? $request->query->get('id') : -1;
        $description = $request->query->get('description') ? $request->query->get('description') : '';
        $status =  $request->query->get('status') > -1 ? $request->query->get('status') : 99;
        $deleteflag = $request->query->get('deleteflag') > -1 ? $request->query->get('deleteflag') : 99;
        $this->taskRepository->update($id, $description, $status, $deleteflag);
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->setContent('Update Successful');
        return $response;
    }

    /**
    * @Route("/api/todolist/add", name="add_task")
    * @return \Symfony\Component\HttpFoundation\JsonResponse
    */
    public function add(Request $request)
    {
        $response = new Response();
        $description = $request->query->get('description') ? $request->query->get('description') : '';
        if ($description === '') return $response->setContent('Description empty');
        $this->taskRepository->add($description);

        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->setContent('Add Successful');
        return $response;
    }

}

?>