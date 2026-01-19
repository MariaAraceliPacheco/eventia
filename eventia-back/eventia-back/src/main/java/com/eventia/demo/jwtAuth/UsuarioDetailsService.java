package com.eventia.demo.jwtAuth;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.core.userdetails.UserDetails;
import org.springframework.security.core.userdetails.UserDetailsService;
import org.springframework.security.core.userdetails.UsernameNotFoundException;
import org.springframework.stereotype.Service;
import org.springframework.security.core.userdetails.User;

import com.eventia.demo.entidades.Usuario;
import com.eventia.demo.repositories.UsuarioRepository;

@Service
public class UsuarioDetailsService implements UserDetailsService {

	@Autowired
	private UsuarioRepository usuarioRepo;

	@Override
	public UserDetails loadUserByUsername(String email) throws UsernameNotFoundException {
		Usuario usuario = usuarioRepo.findByEmail(email)
				.orElseThrow(() -> new UsernameNotFoundException("Usuario no encontrado"));


	    System.out.println("Usuario encontrado: " + usuario.getEmail());
		
		// Se convierte el usuario obtenido de la BD a UserDetails
		return User.builder().username(usuario.getEmail()) 
				.password(usuario.getPassword()) // debe estar codificada con BCrypt
				.roles("USER") // con esto se pueden mapear roles si se tienen en la BD
				.build();
	}

	
}
