package com.eventia.demo.repositories;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import com.eventia.demo.entidades.Artista;

@Repository
public interface ArtistaRepository extends JpaRepository<Artista, Integer>{

}
