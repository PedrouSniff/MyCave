<?php

namespace App\Controller;

use Symfony\Component\Uid\Uuid;
use Symfony\Component\Mime\Email;
use App\Repository\UserRepository;
use App\Form\ResetPasswordRequestType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class LostPasswordController extends AbstractController
{
    #[Route('/lost/password', name: 'app_lost_password')]
    public function index(Request $request, UserRepository $userRepository, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ResetPasswordRequestType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = $form->get('email')->getData();
            $user = $userRepository->findOneBy(['email' => $email]);

            if ($user) {
                $token = Uuid::v4()->toRfc4122();
                $user->setResetToken($token);
                $user->setResetTokenExpiresAt((new \DateTime())->modify('+1 hour'));
                $entityManager->flush();

                $resetLink = $this->generateUrl('app_reset_password', ['token' => $token], UrlGeneratorInterface::ABSOLUTE_URL);

                $email = (new Email())
                    ->from('noreply@yourdomain.com')
                    ->to($user->getEmail())
                    ->subject('Rénitialisation de votre mot de passe')
                    ->text("Voici votre lien de réinitialisation : $resetLink");

                    $mailer->send($email);

                    $this->addFlash('success', 'Un email de rénitialisation a été envoyé.');

                    return $this->redirectToRoute('app_login');
            }

            $this->addFlash('error','Aucun utilisateur trouvé pour cet email.');
        }

        return $this->render('lost_password/lost_password.html.twig', [
            'requestForm' => $form->createView(),
        ]);
    }
}
