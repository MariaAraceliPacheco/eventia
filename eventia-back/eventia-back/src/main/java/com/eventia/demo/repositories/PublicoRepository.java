package com.eventia.demo.repositories;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import com.eventia.demo.entidades.Publico;

@Repository
public interface PublicoRepository extends JpaRepository<Publico, Integer>{

}
