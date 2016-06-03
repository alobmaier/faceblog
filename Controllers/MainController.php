<?php

class MainController extends Controller
{
    public function GET_index()
    {
        return $this->renderView('Home', new BaseModel());
    }

    public function GET_List()
    {
        $categories = DataManager::getCategories();

        $books = $this->getParameter('categoryId') ? DataManager::getBooksForCategory($this->getParameter('categoryId')) : null;

        return $this->renderView('List', new ListModel($categories,
            $books,
            ShoppingCart::getAll(),
            Controller::buildActionLink('List',
                'Main',
                array('categoryId' => $this->getParameter('categoryId')))));
    }
    public function GET_Search()
    {
        $books = $this->hasParameter('title') ? DataManager::getBooksForSearchCriteria($this->getParameter('title')) : null;
        
        return $this->renderView('Search',
            new SearchModel($this->getParameter('title'),
                $books,
                ShoppingCart::getAll(),
                Controller::buildActionLink('Search', 'Main', array('title'))));
    }
    public function POST_AddToCart()
    {
        ShoppingCart::add($this->getParameter('bookId'));
        return $this->redirectToUrl($this->getParameter('context'));

    }
    public function POST_RemoveFromCart()
    {
        ShoppingCart::remove($this->getParameter('bookId'));
        return $this->redirectToUrl($this->getParameter('context'));
    }
    public function GET_Checkout()
    {
        if(!AuthenticationManager::isAuthenticated())
            $this->redirect('Login', 'User');
        $cartSize = ShoppingCart::size();

        if($cartSize == 0)
        {
            return $this->renderView('CheckoutEmptyCart', new BaseModel());
        }
        else
        {
            return $this->renderView('Checkout',
                new CheckoutModel($cartSize,
                    $this->getParameter('nameOnCard'),
                    $this->getParameter('cardNumber')));

        }

    }
    public function POST_Checkout()
    {
        $cartSize = ShoppingCart::size();

        $errors = array();

        $nameOnCard = $this->getParameter('nameOnCard') ? trim($this->getParameter('nameOnCard')) : null;
        if($nameOnCard == null || strlen($nameOnCard) == 0)
        {
            $errors[] = 'Invalid name on card.';
        }
        $cardNumber = $this->getParameter('cardNumber') ? str_replace(' ', '', $this->getParameter('cardNumber')) : null;

        if($cardNumber == null || strlen($cardNumber) != 16 || ctype_digit($cardNumber))
        {
            $errors[] = 'Invalid card number.';
        }
        if(count($errors) > 0)
        {
            return $this->renderView('Checkout', new CheckoutModel($cartSize, $nameOnCard, $cardNumber, $errors));
        }
        $user = AuthenticationManager::getAuthenticatedUser();
        $orderId = DataManager::createOrder($user->getId(), ShoppingCart::getAll(), $nameOnCard, $cardNumber);
        if(!$orderId)
        {
            // placing of order failed
            return $this->renderView('Checkout', new CheckoutModel($cartSize, $nameOnCard, $cardNumber, array('Could not create order.')));
        }
        // success --> clear cart and redirect
        ShoppingCart::clear();
        
        return $this->redirect('CheckoutSuccess', 'Main', array('orderId'=>$orderId));
    }
    public function GET_CheckoutSuccess()
    {
        return $this->renderView('CheckoutSuccess', new CheckoutSuccessModel($this->getParameter('orderId')));
    }
}