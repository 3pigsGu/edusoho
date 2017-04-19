<?php

namespace ApiBundle\Api\Resource\Me;

use ApiBundle\Api\ApiRequest;
use ApiBundle\Api\Exception\ApiNotFoundException;
use ApiBundle\Api\Resource\AbstractResource;
use VipPlugin\Biz\Vip\Service\VipService;

class MeVipLevel extends AbstractResource
{
    public function get(ApiRequest $request, $vipLevelId)
    {
        if (!$this->isPluginInstalled('vip')) {
            throw new ApiNotFoundException();
        }

        $status = $this->getVipService()->checkUserInMemberLevel($this->getCurrentUser()->getId(), $vipLevelId);

        return array('isMember' => $status == 'ok');
    }

    /**
     * @return VipService
     */
    private function getVipService()
    {
        return $this->service('VipPlugin:Vip:VipService');
    }
}