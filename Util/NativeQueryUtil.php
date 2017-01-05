<?php

namespace CulturaViva\Util;

use MapasCulturais\App;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * Facilita a execução de queries nativas
 */
final class NativeQueryUtil {

    private $sql;
    private $fields;
    private $paramseters;

    public function __construct($sql, $fields, $paramseters) {
        $this->sql = $sql;
        $this->fields = $fields;
        $this->paramseters = $paramseters;
    }

    public function paginate($page) {
        $total = $this->getTotal();
        return [
            'total' => $total,
            'rows' => $total > 0 ? $this->getResult($page) : []
        ];
    }

    public function getTotal() {
        $app = App::i();
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('count', 'count');
        $data = $app->em->createNativeQuery("SELECT COUNT(*) AS count FROM ($this->sql) e", $rsm)
                ->setParameters($this->paramseters)
                ->getSingleResult();
        return $data['count'];
    }

    public function getResult($page = null) {
        $app = App::i();
        $rsm = new ResultSetMapping();
        foreach ($this->fields as $field) {
            $prop = lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $field))));
            $rsm->addScalarResult($field, $prop);
        }

        $query = "SELECT * FROM ($this->sql) e";
        if ($page != null) {
            $offset = 10 * (max(intval($page), 1) - 1);
            $query .= " LIMIT 10 OFFSET $offset";
        }

        return $app->em->createNativeQuery($query, $rsm)
                        ->setParameters($this->paramseters)
                        ->getResult();
    }

    public function getSingleResult() {
        $app = App::i();
        $rsm = new ResultSetMapping();
        foreach ($this->fields as $field) {
            $prop = lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $field))));
            $rsm->addScalarResult($field, $prop);
        }

        $query = "SELECT * FROM ($this->sql) e LIMIT 1";

        return $app->em->createNativeQuery($query, $rsm)
                        ->setParameters($this->paramseters)
                        ->getSingleResult();
    }

}
