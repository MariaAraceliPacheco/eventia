package com.eventia.demo.repositories;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import com.eventia.demo.entidades.Evento;

@Repository
public interface EventoRepository extends JpaRepository<Evento, Integer>{

}
