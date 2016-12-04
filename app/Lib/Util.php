<?php
/**
 * Projeto GACMS
 *
 * Contém a classe com alguns métodos estáticos para tentativa de auxílio
 * no desenvolvimento de sua aplicação
 *
 * @author 		Rafael Benites <rsobaben@gmail.com>
 * @version 	$Id: Util.php - 2013-10-21- rsobaben $
 * @package     app.Lib
 */

App::uses('Inflector', 'Utility');
App::uses('CakeEmail', 'Network/Email');

/**
 * Util
 *
 * @package     app.Lib
 */
class Util
{
    /**
     * Faz uso do Inflector::slug() para formatar a saída com strtolower
     *
     * @param   string $value
     * @return  string 
     */
    public static function slug($value)
    {
        return strtolower(Inflector::slug($value, '-'));
    }

	/**
	 * Método que devolve o "excerpt" de um texto, segue a ideia do wordpress
	 * Recebe um texto, remove qualquer html presente, e devolve o que for
	 * considerado palavras. 
     *
	 *<code>
	 *<?php 
	 *	$text = '<p>Olá mundo</p>';
	 *	$excp = Util::excerpt($text, 1, '[..]');
	 *  echo $excp; // "olá[..]"
	 *?>
	 *</code>
     *
	 * @param   string $text  texto "raw" a ser processado
	 * @param   integer $num_of_words número de "palavras" a serem retornadas
	 * @param   string $read_more texto a ser adicionado caso o numero de "palavras" no $text exceda o necessário
	 * @return  string
	 */
    public static function excerpt($text, $num_of_words = 20, $read_more = '[..]')
    {
        if (!is_numeric($num_of_words)) {
            $num_of_words = 15;
        }
        $text = preg_replace ('/<br(\s*)\/?>/', ' ', html_entity_decode($text, ENT_QUOTES, 'UTF-8')); 
        $parts = explode(' ', str_replace('&nbsp;', ' ', strip_tags($text)));
        if (count($parts) <= $num_of_words) {
            return implode(" ", $parts);
        }
        $j =0;
        foreach ($parts as $p) {
            if (!empty($p)) {
                $return[$j++] = $p;
            }
            if ($j >= $num_of_words) {
                break;
            }
        }
        return implode(" ", $return) . $read_more;
    }

    /**
     * Inverte data, recebendo o separador da entrada e separador da saída.
     * YYYY-mm-dd <=> dd/mm/YYYY
     *
     * @param   string $data
     * @param   string $separator
     * @param   string $return
     * @return  string
     */
    public static function inverte($data, $separator = '/', $return = '-')
    {
        $data = explode($separator, $data);
        return sprintf(
            '%s%s%s%s%s',
            $data[2],
            $return,
            $data[1],
            $return,
            $data[0]
        );
    }

    /**
     * Verificar se uma determinada data está no formato sql
     *
     * @param   string $data
     * @return  boolean
     */
    public static function isSqlDate($data)
    {
        return preg_match('/[0-9]{4}\-[0-9]{2}\-[0-9]{2}(\s[0-9]{2}\:[0-9]{2}\:-[0-9]{2})?/', $data);
    }

    /**
     * Tranforma uma lista de emails em array 
     *
     *
     * @param array $datainformações parao template
     * @param string|array $emails lista de emails
     * @param string $separator separador
     * @return boolean
     */ 
    public static function multiemail($emails, $separator = ';')
    {
        $result = array();
        if (!is_array($emails))
            $emails = explode($separator, $emails);
        foreach ($emails as $item) {
            $address = trim($item);
            if (!empty($address))
                $result[] = $address;
        }
        return $result;
    }

    /**
     * Envia email usando configuração padrão 
     *
     *
     * @param array $data informações para o template
     * @param string|array $to que receberá o email
     * @param string $subject assunto do email
     * @param string $template a ser usado
     * @param string $layout a ser usado no envio
     * @return boolean
     */ 
    public static function email($data, $to, $subject = 'Contato pelo Site', $template = null, $layout = 'default')
    {
        $to = self::multiemail($to);
        try {
            $email = new CakeEmail('smtp');
            $email->subject($subject)
                  ->to($to)
                  ->emailFormat('html')
                  ->viewVars(array('data' => $data))
                  ->template($template, $layout);
            $email->send();
        } catch(Exception $e) {
            //noop
            return false;
        }
        return true;
    }

    /**
     * Envia email usando configuração para os módulos padrões
     *
     *
     * @param array $config configurações do email
     * @param array $siteConfig configurações do site
     * @return integer
     */ 
    public static function sample_email($config, $siteConfig = null)
    {
        $config += array(
            'subject'     => 'Contato pelo Site',
            'title'       => (isset($siteConfig['titulo']) ? $siteConfig['titulo'] : ''),
            'subtitle'    => (isset($config['subject']) ? $config['subject'] : 'Contato pelo Site'),
            'fields'      => array(),
            'showLink'    => true,
            'footer'      => (isset($siteConfig['endereco']) ? nl2br($siteConfig['endereco']) : ''),
            'layout'      => 'sample',
            'template'    => 'sample',
            'to'          => (isset($siteConfig['email']) ? $siteConfig['email'] : ''),
            'attachments' => array()
        );
        $link = (isset($config['link']) ? $config['link'] : array()) + array(
            'label' => 'Visite nosso site',
            'url'   => array('controller' => 'pages', 'action' => 'home', 'full_base' => true)
        );
        $config['link'] = $link;

        $config['to'] = self::multiemail($config['to']);
        if (empty($config['to']))
            return -1;
        try {
            $email = new CakeEmail('smtp');
            $email->subject($config['subject'])
                  ->to($config['to'])
                  ->emailFormat('html')
                  ->viewVars($config)
                  ->template($config['template'], $config['layout']);
            if (!empty($config['attachments']))
                $email->attachments($config['attachments']);
            $email->send();
        } catch(Exception $e) {
            return 0;
        }
        return 1;
    }
}