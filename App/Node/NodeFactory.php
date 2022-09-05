<?php


namespace App\Node;


class NodeFactory
{
    private const EQUIPMENT_VARIANT =  'Варианты комплектации';

    private const PRODUCT_AND_COMPONENT = 'Изделия и компоненты';

    private const STRAIGHT_COMPONENT = 'Прямые компоненты';

    /**
     * @param array<array<string>> $rawNodes
     * @return NodeMap
     */
    public static function create(array $rawNodes) : NodeMap
    {
        $nodes = new NodeMap();
        foreach ($rawNodes as $rawNode) {
            if (empty($rawNode[1])) {
                continue;
            }
            switch ($rawNode[1]) {
                case self::EQUIPMENT_VARIANT:
                    $nodes->put($rawNode[0], new EquipmentVariant(
                        $rawNode[0],
                        empty($rawNode[2]) ? null : $rawNode[2])
                    );
                    break;
                case self::PRODUCT_AND_COMPONENT:
                    $nodes->put($rawNode[0], new ProductAndComponent(
                        $rawNode[0],
                        empty($rawNode[2]) ? null : $rawNode[2])
                    );
                    break;
                case self::STRAIGHT_COMPONENT:
                    $nodes->put($rawNode[0], new StraightComponent(
                        $rawNode[0],
                        empty($rawNode[2]) ? null : $rawNode[2],
                        empty($rawNode[3]) ? null : $rawNode[3])
                    );
                    break;
            }
        }
        return $nodes;
    }
}