package com.eventia.demo.repositories;

import java.util.Optional;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import com.eventia.demo.entidades.Usuario;

@Repository
public interface UsuarioRepository extends JpaRepository<Usuario, Integer> {

	// JPA interpreta el nombre del metodo y genera automaticamente la query
	// select * from usuario where email = ?
	// Devuelve un optional<Usuario> para que en caso de que no exista, se puede
	// manejar la excepcion
	Optional<Usuario> findByEmail(String email);

}
