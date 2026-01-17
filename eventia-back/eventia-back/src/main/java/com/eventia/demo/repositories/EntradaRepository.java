package com.eventia.demo.repositories;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import com.eventia.demo.entidades.Entrada;

@Repository
public interface EntradaRepository extends JpaRepository<Entrada, Integer>{

}
