<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevDebugProjectContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($rawPathinfo)
    {
        $allow = [];
        $pathinfo = rawurldecode($rawPathinfo);
        $trimmedPathinfo = rtrim($pathinfo, '/');
        $context = $this->context;
        $request = $this->request ?: $this->createRequest($pathinfo);
        $requestMethod = $canonicalMethod = $context->getMethod();

        if ('HEAD' === $requestMethod) {
            $canonicalMethod = 'GET';
        }

        if (0 === strpos($pathinfo, '/_')) {
            // _wdt
            if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, ['_route' => '_wdt']), array (  '_controller' => 'web_profiler.controller.profiler:toolbarAction',));
            }

            if (0 === strpos($pathinfo, '/_profiler')) {
                // _profiler_home
                if ('/_profiler' === $trimmedPathinfo) {
                    $ret = array (  '_controller' => 'web_profiler.controller.profiler:homeAction',  '_route' => '_profiler_home',);
                    if ('/' === substr($pathinfo, -1)) {
                        // no-op
                    } elseif ('GET' !== $canonicalMethod) {
                        goto not__profiler_home;
                    } else {
                        return array_replace($ret, $this->redirect($rawPathinfo.'/', '_profiler_home'));
                    }

                    return $ret;
                }
                not__profiler_home:

                if (0 === strpos($pathinfo, '/_profiler/search')) {
                    // _profiler_search
                    if ('/_profiler/search' === $pathinfo) {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchAction',  '_route' => '_profiler_search',);
                    }

                    // _profiler_search_bar
                    if ('/_profiler/search_bar' === $pathinfo) {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchBarAction',  '_route' => '_profiler_search_bar',);
                    }

                }

                // _profiler_phpinfo
                if ('/_profiler/phpinfo' === $pathinfo) {
                    return array (  '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  '_route' => '_profiler_phpinfo',);
                }

                // _profiler_search_results
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/search/results$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, ['_route' => '_profiler_search_results']), array (  '_controller' => 'web_profiler.controller.profiler:searchResultsAction',));
                }

                // _profiler_open_file
                if ('/_profiler/open' === $pathinfo) {
                    return array (  '_controller' => 'web_profiler.controller.profiler:openAction',  '_route' => '_profiler_open_file',);
                }

                // _profiler
                if (preg_match('#^/_profiler/(?P<token>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, ['_route' => '_profiler']), array (  '_controller' => 'web_profiler.controller.profiler:panelAction',));
                }

                // _profiler_router
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/router$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, ['_route' => '_profiler_router']), array (  '_controller' => 'web_profiler.controller.router:panelAction',));
                }

                // _profiler_exception
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, ['_route' => '_profiler_exception']), array (  '_controller' => 'web_profiler.controller.exception:showAction',));
                }

                // _profiler_exception_css
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception\\.css$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, ['_route' => '_profiler_exception_css']), array (  '_controller' => 'web_profiler.controller.exception:cssAction',));
                }

            }

            // _twig_error_test
            if (0 === strpos($pathinfo, '/_error') && preg_match('#^/_error/(?P<code>\\d+)(?:\\.(?P<_format>[^/]++))?$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, ['_route' => '_twig_error_test']), array (  '_controller' => 'twig.controller.preview_error:previewErrorPageAction',  '_format' => 'html',));
            }

        }

        // default_index
        if ('' === $trimmedPathinfo) {
            $ret = array (  '_controller' => 'AppBundle\\Controller\\DefaultController::indexAction',  '_route' => 'default_index',);
            if ('/' === substr($pathinfo, -1)) {
                // no-op
            } elseif ('GET' !== $canonicalMethod) {
                goto not_default_index;
            } else {
                return array_replace($ret, $this->redirect($rawPathinfo.'/', 'default_index'));
            }

            if (!in_array($canonicalMethod, ['GET'])) {
                $allow = array_merge($allow, ['GET']);
                goto not_default_index;
            }

            return $ret;
        }
        not_default_index:

        // default_login
        if ('/login' === $pathinfo) {
            $ret = array (  '_controller' => 'AppBundle\\Controller\\DefaultController::loginAction',  '_route' => 'default_login',);
            if (!in_array($requestMethod, ['POST'])) {
                $allow = array_merge($allow, ['POST']);
                goto not_default_login;
            }

            return $ret;
        }
        not_default_login:

        if (0 === strpos($pathinfo, '/logCuidados')) {
            // logCuidados_list
            if (preg_match('#^/logCuidados(?:/(?P<id>[^/]++))?$#sD', $pathinfo, $matches)) {
                $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'logCuidados_list']), array (  '_controller' => 'AppBundle\\Controller\\LogCuidadosController::logCuidadosAction',  'id' => NULL,));
                if (!in_array($requestMethod, ['POST'])) {
                    $allow = array_merge($allow, ['POST']);
                    goto not_logCuidados_list;
                }

                return $ret;
            }
            not_logCuidados_list:

            // logCuidados_new
            if (0 === strpos($pathinfo, '/logCuidados/new') && preg_match('#^/logCuidados/new(?:/(?P<id>[^/]++))?$#sD', $pathinfo, $matches)) {
                $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'logCuidados_new']), array (  '_controller' => 'AppBundle\\Controller\\LogCuidadosController::newAction',  'id' => NULL,));
                if (!in_array($requestMethod, ['POST'])) {
                    $allow = array_merge($allow, ['POST']);
                    goto not_logCuidados_new;
                }

                return $ret;
            }
            not_logCuidados_new:

            // logCuidados_remove
            if (0 === strpos($pathinfo, '/logCuidados/remove') && preg_match('#^/logCuidados/remove(?:/(?P<id>[^/]++))?$#sD', $pathinfo, $matches)) {
                $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'logCuidados_remove']), array (  '_controller' => 'AppBundle\\Controller\\LogCuidadosController::removeAction',  'id' => NULL,));
                if (!in_array($requestMethod, ['POST'])) {
                    $allow = array_merge($allow, ['POST']);
                    goto not_logCuidados_remove;
                }

                return $ret;
            }
            not_logCuidados_remove:

        }

        elseif (0 === strpos($pathinfo, '/user')) {
            // user_new
            if ('/user/new' === $pathinfo) {
                $ret = array (  '_controller' => 'AppBundle\\Controller\\UserController::newAction',  '_route' => 'user_new',);
                if (!in_array($requestMethod, ['POST'])) {
                    $allow = array_merge($allow, ['POST']);
                    goto not_user_new;
                }

                return $ret;
            }
            not_user_new:

            // user_edit
            if ('/user/edit' === $pathinfo) {
                $ret = array (  '_controller' => 'AppBundle\\Controller\\UserController::editAction',  '_route' => 'user_edit',);
                if (!in_array($requestMethod, ['POST'])) {
                    $allow = array_merge($allow, ['POST']);
                    goto not_user_edit;
                }

                return $ret;
            }
            not_user_edit:

            if (0 === strpos($pathinfo, '/userBonsai')) {
                // userBonsai_list
                if ('/userBonsai/list' === $pathinfo) {
                    $ret = array (  '_controller' => 'AppBundle\\Controller\\UserBonsaiController::userBonsaiAction',  '_route' => 'userBonsai_list',);
                    if (!in_array($requestMethod, ['POST'])) {
                        $allow = array_merge($allow, ['POST']);
                        goto not_userBonsai_list;
                    }

                    return $ret;
                }
                not_userBonsai_list:

                // userBonsai_new
                if ('/userBonsai/new' === $pathinfo) {
                    $ret = array (  '_controller' => 'AppBundle\\Controller\\UserBonsaiController::newAction',  '_route' => 'userBonsai_new',);
                    if (!in_array($requestMethod, ['POST'])) {
                        $allow = array_merge($allow, ['POST']);
                        goto not_userBonsai_new;
                    }

                    return $ret;
                }
                not_userBonsai_new:

                // userBonsai_edit
                if (0 === strpos($pathinfo, '/userBonsai/edit') && preg_match('#^/userBonsai/edit(?:/(?P<id>[^/]++))?$#sD', $pathinfo, $matches)) {
                    $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'userBonsai_edit']), array (  '_controller' => 'AppBundle\\Controller\\UserBonsaiController::newAction',  'id' => NULL,));
                    if (!in_array($requestMethod, ['POST'])) {
                        $allow = array_merge($allow, ['POST']);
                        goto not_userBonsai_edit;
                    }

                    return $ret;
                }
                not_userBonsai_edit:

                // userBonsai_detail
                if (0 === strpos($pathinfo, '/userBonsai/detail') && preg_match('#^/userBonsai/detail(?:/(?P<id>[^/]++))?$#sD', $pathinfo, $matches)) {
                    $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'userBonsai_detail']), array (  '_controller' => 'AppBundle\\Controller\\UserBonsaiController::detailAction',  'id' => NULL,));
                    if (!in_array($requestMethod, ['POST'])) {
                        $allow = array_merge($allow, ['POST']);
                        goto not_userBonsai_detail;
                    }

                    return $ret;
                }
                not_userBonsai_detail:

                // userBonsai_search
                if (0 === strpos($pathinfo, '/userBonsai/search') && preg_match('#^/userBonsai/search(?:/(?P<search>[^/]++))?$#sD', $pathinfo, $matches)) {
                    $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'userBonsai_search']), array (  '_controller' => 'AppBundle\\Controller\\UserBonsaiController::searchAction',  'search' => NULL,));
                    if (!in_array($requestMethod, ['POST'])) {
                        $allow = array_merge($allow, ['POST']);
                        goto not_userBonsai_search;
                    }

                    return $ret;
                }
                not_userBonsai_search:

                // userBonsai_remove
                if (0 === strpos($pathinfo, '/userBonsai/remove') && preg_match('#^/userBonsai/remove(?:/(?P<id>[^/]++))?$#sD', $pathinfo, $matches)) {
                    $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'userBonsai_remove']), array (  '_controller' => 'AppBundle\\Controller\\UserBonsaiController::removeAction',  'id' => NULL,));
                    if (!in_array($requestMethod, ['POST'])) {
                        $allow = array_merge($allow, ['POST']);
                        goto not_userBonsai_remove;
                    }

                    return $ret;
                }
                not_userBonsai_remove:

            }

        }

        if ('/' === $pathinfo && !$allow) {
            throw new Symfony\Component\Routing\Exception\NoConfigurationException();
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
