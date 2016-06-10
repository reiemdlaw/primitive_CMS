<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\RedirectController;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Pages;

class DefaultController extends Controller
{
	/**
	* @Route("/{url}/delete", name="delete")
	*/
	public function deleteAction(Request $request, $url)
	{
		$em = $this->getDoctrine()->getManager();
		$repository = $em->getRepository('AppBundle:Pages');
		$page = $repository->findOneByUrl($url);
		$em->remove($page);
		$em->flush();
		//toDo:nav to Class
		$navO=$repository->findAll();
		$nav="<table><tr><td>view</td><td>edit</td><td>delete</a></td></tr>";
		foreach($navO as $value)
		{
			$nav .= "<tr><td><a href=\"../".$value->getUrl()."\">".$value->getLinktext()."</a></td><td><a href=\"../".$value->getUrl()."/edit\">".$value->getLinktext()."</td><td><a href=\"../".$value->getUrl()."/delete\">delete</a></td></tr>";
		}
		$nav .= "</table><a href=\"create\">new</a>";
		return $this->render('default/edit.html.twig', [
		'id' => '0',
		'headline' => '',
		'url' => '',
		'linktext' => '',
		'maintext' => '',
		'nav'=> $nav
		]);
	}
	/**
	* @Route("/{url}/edit", name="edit")
	*/
	public function editAction(Request $request, $url)
	{ 
		$em = $this->getDoctrine()->getManager();
		$repository = $em->getRepository('AppBundle:Pages');
		$page = $repository->findOneByUrl($url);
		//ToDo:notfound
		if($_POST)
		{
			if($_POST["id"]==0)
			{
				$page = new Pages();
				$page->setLinktext($_POST["linktext"]);
				$page->setUrl($_POST["url"]);
				$page->setHeadline($_POST["headline"]);
				$page->setMaintext($_POST["maintext"]);
				$em->persist($page);
				$em->flush();
			}
			else
			{
				$page->setLinktext($_POST["linktext"]);
				$page->setUrl($_POST["url"]);
				$page->setHeadline($_POST["headline"]);
				$page->setMaintext($_POST["maintext"]);
				$em->flush();
			}
		}
		$navO=$repository->findAll();
		$nav="<table><tr><td>view</td><td>edit</td><td>delete</a></td></tr>";
		foreach($navO as $value)
		{
			$nav .= "<tr><td><a href=\"../".$value->getUrl()."\">".$value->getLinktext()."</td><td><a href=\"../".$value->getUrl()."/edit\">".$value->getLinktext()."</td><td><a href=\"../".$value->getUrl()."/delete\">delete</a></td></tr>";
		}
		$nav .= "</table><a href=\"create\">new</a>";


		return $this->render('default/edit.html.twig', [
		'id' => $page->getId(),
		'headline' => $page->getHeadline(),
		'url' => $page->getUrl(),
		'linktext' => $page->getLinktext(),
		'maintext' => $page->getMaintext(),
		'nav'=> $nav
		]);
	}
	/**
	* @Route("/{url}/create", name="create")
	* @Method("GET")
	*/
	public function createAction()
	{
		return $this->render('default/edit.html.twig', [
		'id' => '0',
		'headline' => '',
		'url' => '',
		'linktext' => '',
		'maintext' => '',
		'nav'=> ""
		]);
	}
	/**
	* @Route("/", name="new")
	* @Route("/edit", name="new2")
	* @Method("POST")
	*/
	public function newAction(Request $request)
	{ 
		$em = $this->getDoctrine()->getManager();
		$repository = $em->getRepository('AppBundle:Pages');
		if($_POST)
		{
			if($_POST["id"]==0)
			{
				$page = new Pages();
				$page->setLinktext($_POST["linktext"]);
				$page->setUrl($_POST["url"]);
				$page->setHeadline($_POST["headline"]);
				$page->setMaintext($_POST["maintext"]);
				$em->persist($page);
				$em->flush();
			}
		}
		$navO=$repository->findAll();
		$nav="<table><tr><td>view</td><td>edit</td><td>delete</a></td></tr>";
		foreach($navO as $value)
		{
			$nav .= "<tr><td><a href=\"../".$value->getUrl()."\">".$value->getLinktext()."</td><td><a href=\"../".$value->getUrl()."/edit\">".$value->getLinktext()."</td><td><a href=\"../".$value->getUrl()."/delete\">delete</a></td></tr>";
		}
		$nav .= "</table><a href=\"create\">new</a>";


		return $this->render('default/edit.html.twig', [
		'id' => $page->getId(),
		'headline' => $page->getHeadline(),
		'url' => $page->getUrl(),
		'linktext' => $page->getLinktext(),
		'maintext' => $page->getMaintext(),
		'nav'=> $nav
		]);
	}
	/**
	* @Route("/{url}", name="page")
	*/
	public function indexAction(Request $request,$url)
	{
		// getpagecontent
		$repository=$this->getDoctrine()->getManager()->getRepository('AppBundle:Pages');
		$page =$repository->findOneByUrl($url);

		//toDo:Notfound
		if($page)
		{
			$navO=$repository->findAll();
			$nav="<div id=\"navigation\"><ul>";
			foreach($navO as $value)
			{
				if($value->getUrl()==$url)
				{
					$nav .= "<li>".$value->getLinktext()."</li>";
				}else{
					$nav .= "<li><a href=\"".$value->getUrl()."\">".$value->getLinktext()."</a></li>";
				}
			}
			$nav .= "</ul><a href=\"".$page->getUrl()."/edit\">edit this page</a></div>";
			return $this->render('default/page.html.twig', [
			'id' => $page->getId(),
			'headline' => $page->getHeadline(),
			'url' => $page->getUrl(),
			'linktext' => $page->getLinktext(),
			'maintext' => $page->getMaintext(),
			'nav'=> $nav
			]);
		} else {
		 return $this->redirectToRoute('create',['url'=>$url]);
		/**
			return $this->render('default/edit.html.twig', [
		'id' => '0',
		'headline' => '',
		'url' => '',
		'linktext' => '',
		'maintext' => '',
		'nav'=> ""
		]);
		*/
		}
	}

}