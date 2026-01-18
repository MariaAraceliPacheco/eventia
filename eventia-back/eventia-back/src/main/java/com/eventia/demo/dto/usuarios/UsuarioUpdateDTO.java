package com.eventia.demo.dto.usuarios;

import io.swagger.v3.oas.annotations.media.Schema;

public class UsuarioUpdateDTO {

	public enum TipoUsuario {
		publico, artista, ayuntamiento
	}

	private String nombre;
	private String email;
	private String password;
	
	@Schema(description = "Tipo_usuario", example = "publico, artista o ayuntamiento", allowableValues = { "publico",
			"artista", "ayuntamiento" })
	private TipoUsuario tipo_usuario;

	public UsuarioUpdateDTO(String nombre, String email, String password, TipoUsuario tipo_usuario) {
		super();
		this.nombre = nombre;
		this.email = email;
		this.password = password;
		this.tipo_usuario = tipo_usuario;
	}

	public UsuarioUpdateDTO() {
		super();
	}

	public String getNombre() {
		return nombre;
	}

	public void setNombre(String nombre) {
		this.nombre = nombre;
	}

	public String getEmail() {
		return email;
	}

	public void setEmail(String email) {
		this.email = email;
	}

	public String getPassword() {
		return password;
	}

	public void setPassword(String password) {
		this.password = password;
	}

	public TipoUsuario getTipo_usuario() {
		return tipo_usuario;
	}

	public void setTipo_usuario(TipoUsuario tipo_usuario) {
		this.tipo_usuario = tipo_usuario;
	}

}
