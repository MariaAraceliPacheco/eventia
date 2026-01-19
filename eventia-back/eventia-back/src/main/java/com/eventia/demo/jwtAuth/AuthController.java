package com.eventia.demo.jwtAuth;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.authentication.AuthenticationManager;
import org.springframework.security.authentication.UsernamePasswordAuthenticationToken;
import org.springframework.security.core.Authentication;
import org.springframework.security.core.userdetails.UserDetails;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import io.swagger.v3.oas.annotations.parameters.RequestBody;

@RestController
@RequestMapping("/auth")
public class AuthController {

	//se encarga de comprobar usuario
	//varifica contraseña
	//lanzar errores si falla
	@Autowired
	private AuthenticationManager authManager;
	
	//genera el JWT y firma el token
	@Autowired
	private JwtService jwtService;
	
	@PostMapping("/login")
	public String login(@RequestBody LoginDTO dto) {
		
		//Spring internamente busca el usuario (UserDetailService)
		//Compara password con PasswordEncoder
		//Si falla --> 401 Unauthorized
		//Si acierta se crea Authentication
		Authentication auth = authManager.authenticate(new UsernamePasswordAuthenticationToken(dto.getEmail(), dto.getPassword()));
		
		//auth.getPrincipal() devuelve el UserDetails con username y roles
		return jwtService.generarToken((UserDetails) auth.getPrincipal());
	}
	
}
