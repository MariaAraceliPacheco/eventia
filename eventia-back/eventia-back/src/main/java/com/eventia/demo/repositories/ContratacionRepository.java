package com.eventia.demo.repositories;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import com.eventia.demo.entidades.Contratacion;

@Repository
public interface ContratacionRepository extends JpaRepository<Contratacion, Integer>{

}
