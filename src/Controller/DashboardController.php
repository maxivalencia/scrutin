<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BureauRepository;
use App\Repository\CandidatRepository;
use App\Repository\CodeRepository;
use App\Repository\CommuneRepository;
use App\Repository\DistrictRepository;
use App\Repository\ElecteurRepository;
use App\Repository\FokontanyRepository;
use App\Repository\MessagesRepository;
use App\Repository\ModeRepository;
use App\Repository\PopulationRepository;
use App\Repository\ProvinceRepository;
use App\Repository\RegionRepository;
use App\Repository\ResultatRepository;
use App\Repository\SessionRepository;
use App\Repository\TourRepository;
use App\Repository\UserRepository;
use App\Repository\VoteRepository;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(BureauRepository $bureauRepository, CandidatRepository $candidatRepository, CodeRepository $codeRepository, CommuneRepository $communeRepository, DistrictRepository $districtRepository, ElecteurRepository $electeurRepository, FokontanyRepository $fokontanyRepository, MessagesRepository $messagesRepository, ModeRepository $modeRepository, PopulationRepository $populationRepository, ProvinceRepository $provinceRepository, RegionRepository $regionRepository, ResultatRepository $resultatRepository, SessionRepository $sessionRepository, TourRepository $tourRepository, UserRepository $userRepository, VoteRepository $voteRepository): Response
    {
        $session = $sessionRepository->findOneBy([],["id" => "DESC"]);
        
        // récupération du nombre de population
        $populations = $populationRepository->findAll();
        $populationCount = 0;
        foreach ($populations as $population) {
            # code...
            $populationCount = $populationCount + $population->getPopulation();
        }

        // récupération du nombre de bureau de vote
        $bureaux = $bureauRepository->findAll();
        $bureauCount = 0;
        foreach ($bureaux as $bureau) {
            # code...
            $bureauCount = $bureauCount + 1;
        }

        // récupération du nombre de candidat
        $candidats = $candidatRepository->findAll();
        $candidatCount = 0;
        foreach ($candidats as $candidat) {
            # code...
            $candidatCount = $candidatCount + 1;
        }

        // récupération du nombre de vote
        $resultats = $resultatRepository->findAll();
        $voteCount = 0;
        foreach ($resultats as $resultat) {
            # code...
            $voteCount = $voteCount + $resultat->getNombre();
        }

        // récupération du nombre de fokontany
        $fokontanies = $fokontanyRepository->findAll();
        $fonkontanyCount = 0;
        foreach ($fokontanies as $fokontany) {
            # code...
            $fonkontanyCount = $fonkontanyCount + 1;
        }

        // récupération du nombre de commune
        $communes = $communeRepository->findAll();
        $communeCount = 0;
        foreach ($communes as $commune) {
            # code...
            $communeCount = $communeCount + 1;
        }

        // récupération du nombre de disctrict
        $districts = $districtRepository->findAll();
        $districtCount = 0;
        foreach ($districts as $district) {
            # code...
            $districtCount = $districtCount + 1;
        }

        // récupération du nombre de région
        $regions = $regionRepository->findAll();
        $regionCount = 0;
        foreach ($regions as $region) {
            # code...
            $regionCount = $regionCount + 1;
        }

        // récupération du nombre de province
        $provinces = $provinceRepository->findAll();
        $provinceCount = 0;
        foreach ($provinces as $province) {
            # code...
            $provinceCount = $provinceCount + 1;
        }

        return $this->render('dashboard/index.html.twig', [
            'session' => $session,
            'population' => $populationCount,
            'bureau' => $bureauCount,
            'candidat' => $candidatCount,
            'vote' => $voteCount,
            'fokontany' => $fonkontanyCount,
            'commune' => $communeCount,
            'district' => $districtCount,
            'region' => $regionCount,
            'province' => $provinceCount,
            'controller_name' => 'Dashboard',
        ]);
    }
}
