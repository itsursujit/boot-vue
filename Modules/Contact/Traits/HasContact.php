<?php
/**
 * Created by IntelliJ IDEA.
 * User: spbaniya
 * Date: 8/29/18
 * Time: 12:32 PM
 */

namespace Modules\Contact\Traits;


use Modules\Contact\Entities\Contact;

trait HasContact
{

    public function contacts()
    {
        return $this->morphMany(Contact::class, 'contactable');
    }
}
