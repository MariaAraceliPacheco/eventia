package com.eventia.demo.dto;

public class UsuarioInsertDTO {
	private String nombre;
	private String email;
	private String password;
	private String tipo_usuario;

	public UsuarioInsertDTO(String nombre, String email, String password, String tipo_usuario) {
		super();
		this.nombre = nombre;
		this.email = email;
		this.password = password;
		this.tipo_usuario = tipo_usuario;
	}

	public UsuarioInsertDTO() {
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

	public String getTipo_usuario() {
		return tipo_usuario;
	}

	public void setTipo_usuario(String tipo_usuario) {
		this.tipo_usuario = tipo_usuario;
	}

}
