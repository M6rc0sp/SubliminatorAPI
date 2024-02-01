<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Serializer\OrderNormalizer;

class OrderController extends AbstractController
{
    private $orderRepository;
    private $serializer;

    public function __construct(OrderRepository $orderRepository, OrderNormalizer $serializer)
    {
        $this->orderRepository = $orderRepository;
        $this->serializer = $serializer;
    }

    #[Route('/orders', name: 'get_orders', methods: ['GET'])]
    public function getOrders(Request $request): Response
    {
        $term = $request->query->get('term', '');
        $page = $request->query->get('page', 1);
        $pageSize = $request->query->get('itemsPerPage', 10);

        $orders = $this->orderRepository->findAll($term, $page, $pageSize);

        $data = $this->serializer->normalize($orders, 'json');

        $json = json_encode($data);

        return new Response($json, 200, ['Content-Type' => 'application/json']);
    }

    #[Route('/orders/{id}/cancel', name: 'cancel_order', methods: ['PUT'])]
    public function cancelOrder($id): Response
    {
        try {
            $this->orderRepository->cancelOrder($id);
            return new Response('Order cancelled successfully', 204);
        } catch (\Exception $e) {
            return new Response($e->getMessage(), 404);
        }
    }
}
