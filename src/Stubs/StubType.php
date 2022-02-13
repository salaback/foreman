<?php

namespace Alablaster\Foreman\Stubs;

enum StubType: string
{
    case Collection = 'collection';
    case Controller = 'resource-controller';
    case Factory = 'factory';
    case Migration = 'migration';
    case Model = 'model';
    case NewRoute = 'new-route';
    case NewRouteDomain = 'new-route-domain';
    case Request = 'request';
    case Resource = 'resource';
    case ResourceCollection = 'resource-collection';
    case Routes = 'routes';
}
