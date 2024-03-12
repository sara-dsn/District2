<?php
namespace App\EventSubscriber;

    use Doctrine\ORM\Events;
    use Symfony\Component\Mime\Email;
    use Symfony\Bundle\SecurityBundle\Security;
    use App\Repository\PlatRepository;
    use Doctrine\Common\EventSubscriber;
    use Symfony\Component\Mailer\MailerInterface;
    use Doctrine\Persistence\Event\LifecycleEventArgs;
    //use Symfony\Component\HttpFoundation\Session\SessionInterface;
    use Symfony\Component\HttpFoundation\RequestStack;
    use Psr\Log\LoggerInterface;

   class CommandeSubscriber implements EventSubscriber
   {
    private $platRepo;
    private $mailer;
    private $security;
    private $requestStack;
    //private $session;
    private $logger;
    public function __construct( MailerInterface $mailer, PlatRepository $platRepo, Security $security,RequestStack $requestStack, LoggerInterface $logger)
    {    
        $this->platRepo = $platRepo;
        $this->mailer = $mailer;
        $this->security=$security;
        $this->requestStack = $requestStack;
        //$this->session=$session;
        $this->logger = $logger;
    }

    public function getSubscribedEvents()
    {
        //retourne un tableau d'événements (prePersist, postPersist, preUpdate etc...)
        return [      
        //événement déclenché après l'insertion dans la base de donnée:
        Events::postPersist,           
        
        ];
    }

    
    // Envoyer un mail de confirmation de commande:
    public function postPersist(LifecycleEventArgs $args)
    {        

        $entity = $args->getObject();
        // Vérifier que l'entité est une commande
        if (!$entity instanceof \App\Entity\Commande) {
            return;
        }
        //$this->logger->critical('AAAAAA'.print_r($this->session));
        // Récupere le panier:

        $request = $this->requestStack->getCurrentRequest();
        $session = $request->getSession();

        $panier=$session->get('panier',[]);
    
        // Récupere l'email de l'utilisateur:
        $user=$this->security->getUser();
        $mail=$user->getUserIdentifier();           
        $liste="";
        //  $adresseLivraison=$form->get('adresseLivraison')->getData();
        foreach($panier as $id=>$quantity){
            $plat=$this->platRepo->find($id)->getLibelle();
            $liste=$liste." ".$quantity." ".$plat." et ";
        }
        $email = (new Email())
        ->from('The_District@gmail.com')
        ->to($mail)
        //->cc('cc@example.com')
        //->bcc('bcc@example.com')
        //->replyTo('fabien@example.com')
        //->priority(Email::PRIORITY_HIGH)
        ->subject('Votre Commande est en préparation !')
        ->html("Merci d'avoir commander chez nous !<br> Le livreur vous contactera quand il récéptionnera votre commande de ");
        // .$liste." <br>  il vous la livrera au "
        //  .$adresseLivraison." . " );

        $mail=$this->mailer->send($email);

}
}