<?php

namespace App\Serializer;

use App\Entity\Order;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class OrderNormalizer implements NormalizerInterface
{
    public function normalize($object, string $format = null, array $context = []): array
    {
        $ordersArray = [];

        foreach ($object as $order) {
            $ordersArray[] = [
                'id' => $order->getId(),
                'date' => $order->getDate()->format('Y-m-d H:i:s'),
                'customer' => $order->getCustomer(),
                'address1' => $order->getAddress1(),
                'city' => $order->getCity(),
                'postcode' => $order->getPostCode(),
                'country' => $order->getCountry(),
                'amount' => $order->getAmount(),
                'status' => $order->getStatus(),
                'deleted' => $order->getDeleted(),
                'lastModified' => $order->getLastModified()->format('Y-m-d H:i:s'),
            ];
        }

        return $ordersArray;
    }

    public function supportsNormalization($data, string $format = null, array $context = []): bool
    {
        return $data instanceof Order;
    }

    function getSupportedTypes(?string $format): array
    {
        return [Order::class];
    }
}