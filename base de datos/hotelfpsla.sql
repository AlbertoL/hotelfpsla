USE [master]
GO
/****** Object:  Database [hotelfpsla]    Script Date: 04/05/2016 17:53:48 ******/
CREATE DATABASE [hotelfpsla] ON  PRIMARY 
( NAME = N'hotelfpsla', FILENAME = N'c:\Program Files\Microsoft SQL Server\MSSQL10_50.SQLEXPRESS\MSSQL\DATA\hotelfpsla.mdf' , SIZE = 3072KB , MAXSIZE = UNLIMITED, FILEGROWTH = 1024KB )
 LOG ON 
( NAME = N'hotelfpsla_log', FILENAME = N'c:\Program Files\Microsoft SQL Server\MSSQL10_50.SQLEXPRESS\MSSQL\DATA\hotelfpsla_log.ldf' , SIZE = 1024KB , MAXSIZE = 2048GB , FILEGROWTH = 10%)
GO
ALTER DATABASE [hotelfpsla] SET COMPATIBILITY_LEVEL = 100
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [hotelfpsla].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [hotelfpsla] SET ANSI_NULL_DEFAULT OFF
GO
ALTER DATABASE [hotelfpsla] SET ANSI_NULLS OFF
GO
ALTER DATABASE [hotelfpsla] SET ANSI_PADDING OFF
GO
ALTER DATABASE [hotelfpsla] SET ANSI_WARNINGS OFF
GO
ALTER DATABASE [hotelfpsla] SET ARITHABORT OFF
GO
ALTER DATABASE [hotelfpsla] SET AUTO_CLOSE OFF
GO
ALTER DATABASE [hotelfpsla] SET AUTO_CREATE_STATISTICS ON
GO
ALTER DATABASE [hotelfpsla] SET AUTO_SHRINK OFF
GO
ALTER DATABASE [hotelfpsla] SET AUTO_UPDATE_STATISTICS ON
GO
ALTER DATABASE [hotelfpsla] SET CURSOR_CLOSE_ON_COMMIT OFF
GO
ALTER DATABASE [hotelfpsla] SET CURSOR_DEFAULT  GLOBAL
GO
ALTER DATABASE [hotelfpsla] SET CONCAT_NULL_YIELDS_NULL OFF
GO
ALTER DATABASE [hotelfpsla] SET NUMERIC_ROUNDABORT OFF
GO
ALTER DATABASE [hotelfpsla] SET QUOTED_IDENTIFIER OFF
GO
ALTER DATABASE [hotelfpsla] SET RECURSIVE_TRIGGERS OFF
GO
ALTER DATABASE [hotelfpsla] SET  DISABLE_BROKER
GO
ALTER DATABASE [hotelfpsla] SET AUTO_UPDATE_STATISTICS_ASYNC OFF
GO
ALTER DATABASE [hotelfpsla] SET DATE_CORRELATION_OPTIMIZATION OFF
GO
ALTER DATABASE [hotelfpsla] SET TRUSTWORTHY OFF
GO
ALTER DATABASE [hotelfpsla] SET ALLOW_SNAPSHOT_ISOLATION OFF
GO
ALTER DATABASE [hotelfpsla] SET PARAMETERIZATION SIMPLE
GO
ALTER DATABASE [hotelfpsla] SET READ_COMMITTED_SNAPSHOT OFF
GO
ALTER DATABASE [hotelfpsla] SET HONOR_BROKER_PRIORITY OFF
GO
ALTER DATABASE [hotelfpsla] SET  READ_WRITE
GO
ALTER DATABASE [hotelfpsla] SET RECOVERY SIMPLE
GO
ALTER DATABASE [hotelfpsla] SET  MULTI_USER
GO
ALTER DATABASE [hotelfpsla] SET PAGE_VERIFY CHECKSUM
GO
ALTER DATABASE [hotelfpsla] SET DB_CHAINING OFF
GO
USE [hotelfpsla]
GO
/****** Object:  Table [dbo].[tb_tipo]    Script Date: 04/05/2016 17:53:49 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tb_tipo](
	[tp_id] [int] IDENTITY(1,1) NOT NULL,
	[tp_nombre] [varchar](50) NOT NULL,
 CONSTRAINT [PK_tb_tipo] PRIMARY KEY CLUSTERED 
(
	[tp_id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[tb_estado]    Script Date: 04/05/2016 17:53:49 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tb_estado](
	[es_id] [int] IDENTITY(1,1) NOT NULL,
	[es_nombre] [varchar](20) NOT NULL,
 CONSTRAINT [PK_tb_estado] PRIMARY KEY CLUSTERED 
(
	[es_id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[tb_usuario]    Script Date: 04/05/2016 17:53:49 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tb_usuario](
	[us_id] [int] IDENTITY(1,1) NOT NULL,
	[us_rut] [varchar](13) NOT NULL,
	[us_nombre] [varchar](50) NOT NULL,
	[us_apellido] [nvarchar](50) NOT NULL,
	[us_password] [varchar](250) NOT NULL,
	[us_tipo] [int] NOT NULL,
	[us_estado] [int] NOT NULL,
 CONSTRAINT [PK_tb_usuario] PRIMARY KEY CLUSTERED 
(
	[us_id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
CREATE NONCLUSTERED INDEX [IX_tb_usuario] ON [dbo].[tb_usuario] 
(
	[us_id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[registro]    Script Date: 04/05/2016 17:53:49 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[registro](
	[id_contable] [int] IDENTITY(1,1) NOT NULL,
	[f_mes_contable] [date] NOT NULL,
	[fecha_consulta] [datetime] NOT NULL,
	[fk_us_id] [int] NOT NULL,
 CONSTRAINT [PK_registro] PRIMARY KEY CLUSTERED 
(
	[id_contable] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  ForeignKey [FK_tb_usuario_tb_estado]    Script Date: 04/05/2016 17:53:49 ******/
ALTER TABLE [dbo].[tb_usuario]  WITH CHECK ADD  CONSTRAINT [FK_tb_usuario_tb_estado] FOREIGN KEY([us_estado])
REFERENCES [dbo].[tb_estado] ([es_id])
GO
ALTER TABLE [dbo].[tb_usuario] CHECK CONSTRAINT [FK_tb_usuario_tb_estado]
GO
/****** Object:  ForeignKey [FK_tb_usuario_tb_tipo]    Script Date: 04/05/2016 17:53:49 ******/
ALTER TABLE [dbo].[tb_usuario]  WITH CHECK ADD  CONSTRAINT [FK_tb_usuario_tb_tipo] FOREIGN KEY([us_tipo])
REFERENCES [dbo].[tb_tipo] ([tp_id])
GO
ALTER TABLE [dbo].[tb_usuario] CHECK CONSTRAINT [FK_tb_usuario_tb_tipo]
GO
/****** Object:  ForeignKey [FK_registro_tb_usuario]    Script Date: 04/05/2016 17:53:49 ******/
ALTER TABLE [dbo].[registro]  WITH CHECK ADD  CONSTRAINT [FK_registro_tb_usuario] FOREIGN KEY([fk_us_id])
REFERENCES [dbo].[tb_usuario] ([us_id])
GO
ALTER TABLE [dbo].[registro] CHECK CONSTRAINT [FK_registro_tb_usuario]
GO
